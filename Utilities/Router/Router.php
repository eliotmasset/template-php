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
            call_user_func($path[0]."::".$path[1]);
        } else { // Or just a file
            require_once self::$controllerFolder."/".self::$routes[$url];
        }

        return true;
    }

}

?>