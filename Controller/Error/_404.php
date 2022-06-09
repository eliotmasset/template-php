<?php

include("Utilities/Logger/Logger.php");

class _404 {

    public static function loadPage() {
        $logger = new Logger("Log", "error.txt");
        $logger->log(2,"Page not found","the page you try to reach don't exist !", 404);
        require_once "Vue/Error/404.php";
    }

}