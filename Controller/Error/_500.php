<?php

include("Utilities/Logger/Logger.php");

class _500 {

    public static function loadPage() {
        $logger = new Logger("Log", "error.txt");
        $logger->log(3,"Internal server error","A critical error append at the server !", 500);
        require_once "Vue/Error/500.php";
    }

}