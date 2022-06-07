<?php

class Router 
{

    //-----------------------------------------------//
    // Private                                       //
    //-----------------------------------------------//

    private static $getValue = "page";

    private static $controllerFolder = "Controller";

    private static $routes = [];

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

    private static function load() {
        if(!file_exists("Config/Router.json")) {
            throw new Exception('Error'." Config Router file not found. \nCheck at Config/Router.json");
        }
        self::$routes = json_decode( file_get_contents("Config/Router.json"),true );
    }

    public static function factory() :bool
    {

        Router::load();

        $url='';

        if( ! isset( $_GET[self::$getValue] ) ) {
            throw new Exception('Error: '."The current getValue is : \"".self::$getValue."\" but is invalid.\n set the getValue by : Router::setGetValue(your Value)");
        }

        $url="/".$_GET[self::$getValue];
        if(!array_key_exists($url,self::$routes))
            throw new Exception('Error: '."The current url is : \"".$url."\" but is invalid.\n Please, set the route in Config/Router.json");
        
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

        return true;
    }

}

?>