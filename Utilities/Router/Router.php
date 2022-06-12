<?php

include_once "Utilities/Logger/Logger.php";

class Router 
{

    //-----------------------------------------------//
    // Private                                       //
    //-----------------------------------------------//

    private static $getValue = "page";

    private static $controllerFolder = "Controller";

    private static $routes = [];

    private static function load($logger) {
        if(!file_exists("Config/Router.json")) {
            $logger->error("FILE_NOT_FOUND"," Config Router file not found. \nCheck at Config/Router.json");
            throw new Exception('Error'." Config Router file not found. \nCheck at Config/Router.json");
        }
        self::$routes = json_decode( file_get_contents("Config/Router.json"),true );
    }

    //-----------------------------------------------//
    // Public                                        //
    //-----------------------------------------------//

    public static function getGetValue() :string
    {
        return self::$getValue;
    }

    public static function getControllerFolder() :string
    {
        return self::$controllerFolder;
    }

    public static function setGetValue(string $getValue) :string
    {
        return ( self::$getValue = $getValue );
    }

    public static function setControllerFolder(string $controllerFolder) :string
    {
        return ( self::$controllerFolder = $controllerFolder );
    }

    public static function error(string $e) {
        $path = explode(".php::",self::$routes["Error"][$e]);
        require_once self::$controllerFolder."/".$path[0].".php";
        call_user_func(preg_replace('/(.*)\/([^\/]*)$/','$2',$path[0])."::".$path[1]);
    }

    public static function factory() :bool
    {
        try {
            $logger = new Logger();

            Router::load($logger);

            $url='';


            if( ! isset( $_GET[self::$getValue] ) ) {
                $logger->error("INVALID_VALUE","The current getValue is : \"".self::$getValue."\" but is invalid.\n set the getValue by : Router::setGetValue(your Value)");
                throw new Exception('Error: '."The current getValue is : \"".self::$getValue."\" but is invalid.\n set the getValue by : Router::setGetValue(your Value)");
            }

            //Specifics files :
                
            if(preg_match('/[^\.]+\.([^\.]+)$/', $_GET[self::$getValue], $matches)) {
                switch($matches[1]) {
                    case "css":
                        if (file_exists('Assets/'.$_GET[self::$getValue])) {
                            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                            header("Cache-Control: public"); // needed for internet explorer
                            header("Content-type: text/css");
                            header("Content-Transfer-Encoding: Binary");
                            header("Content-Length:".filesize('Assets/'.$_GET[self::$getValue]));
                            header("Content-Disposition: attachment; filename=".$_GET[self::$getValue]);
                            return readfile('Assets/'.$_GET[self::$getValue]);
                        }
                        self::error("404");
                        return false;
                        break;
                    case "png":
                    case "jpg":
                    case "jpeg":
                        if (file_exists('Assets/Media/'.$_GET[self::$getValue])) {
                            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                            header("Cache-Control: public"); // needed for internet explorer
                            header("Content-type: image/".$matches[1]);
                            header("Content-Transfer-Encoding: Binary");
                            header("Content-Length:".filesize('Assets/Media/'.$_GET[self::$getValue]));
                            header("Content-Disposition: attachment; filename=".$_GET[self::$getValue]);
                            return readfile('Assets/Media/'.$_GET[self::$getValue]);
                        }
                        self::error("404");
                        return false;
                        break;
                    case "mp3":
                        if (file_exists('Assets/Media/'.$_GET[self::$getValue])) {
                            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                            header("Cache-Control: public"); // needed for internet explorer
                            header("Content-type: audio/mpeg");
                            header("Content-Transfer-Encoding: Binary");
                            header("Content-Length:".filesize('Assets/Media/'.$_GET[self::$getValue]));
                            header("Content-Disposition: attachment; filename=".$_GET[self::$getValue]);
                            return readfile('Assets/Media/'.$_GET[self::$getValue]);
                        }
                        self::error("404");
                        return false;
                        break;
                    case "mp4":
                    case "avi":
                        if (file_exists('Assets/Media/'.$_GET[self::$getValue])) {
                            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                            header("Cache-Control: public"); // needed for internet explorer
                            header("Content-type: video/".$matches[1]);
                            header("Content-Transfer-Encoding: Binary");
                            header("Content-Length:".filesize('Assets/Media/'.$_GET[self::$getValue]));
                            header("Content-Disposition: attachment; filename=".$_GET[self::$getValue]);
                            return readfile('Assets/Media/'.$_GET[self::$getValue]);
                        }
                        self::error("404");
                        return false;
                        break;
                    case "js":
                        if (file_exists('Assets/Javascript/'.$_GET[self::$getValue])) {
                            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                            header("Cache-Control: public"); // needed for internet explorer
                            header("Content-type: application/javascript");
                            header("Content-Transfer-Encoding: Binary");
                            header("Content-Length:".filesize('Assets/Javascript/'.$_GET[self::$getValue]));
                            header("Content-Disposition: attachment; filename=".$_GET[self::$getValue]);
                            return readfile('Assets/Javascript/'.$_GET[self::$getValue]);
                        }
                        self::error("404");
                        return false;
                        break;
                    default:
                        if (file_exists('Assets/'.$_GET[self::$getValue])) {
                            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                            header("Cache-Control: public"); // needed for internet explorer
                            header("Content-type: text/".$matches[1]);
                            header("Content-Transfer-Encoding: Binary");
                            header("Content-Length:".filesize('Assets/Media/'.$_GET[self::$getValue]));
                            header("Content-Disposition: attachment; filename=".$_GET[self::$getValue]);
                            return readfile('Assets/Media/'.$_GET[self::$getValue]);
                        }
                        self::error("404");
                        return false;
                        break;
                }
            }

            $url="/".$_GET[self::$getValue];

            if(substr($url, -1) == '/') { // Remove last / if exist
                $url = substr($url, 0, -1);
            }
            
            if(!array_key_exists($url,self::$routes)) { // Error 404 if url doesn't exist
                self::error("404");
                return false;
            }

            // If we have to call a method
            if(str_contains(self::$routes[$url], ".php::")) {
                $path = explode(".php::",self::$routes[$url]);
                require_once self::$controllerFolder."/".$path[0].".php";
                array_shift($_GET);
                if(empty($_GET)) {
                    call_user_func(preg_replace('/(.*)\/([^\/]*)$/','$2',$path[0])."::".$path[1]);
                } else {
                    $urlStr = preg_replace('/(.*)\/([^\/]*)$/','$2',$path[0])."::".$path[1];
                    foreach ($_GET as $key => $value) {
                        $urlStr = preg_replace("/\?$key/","\"$value\"",$urlStr);
                    }
                    $urlStr = preg_replace("/,\?[^,\)]*/","",$urlStr); //If unspecified params
                    $urlStr = preg_replace("/\?[^,\)]*,/","",$urlStr); //If unspecified params
                    eval("return ".$urlStr.";");// Because we can't do a call_user_func()
                }
            } else { // Or just a file
                require_once self::$controllerFolder."/".self::$routes[$url];
            }
        } catch (\Exception $e) {
            self::error("500");
            return false;
        } catch (\Error $e) {
            self::error("500");
            return false;
        } catch (\Throwable $e) {
            self::error("500");
            return false;
        }

        return true;
    }

}
