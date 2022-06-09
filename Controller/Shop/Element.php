<?php

include("Utilities/Logger/Logger.php");

class Element {

    public static function loadPage($id,$titre="world") {
        $logger = new Logger();
        $logger->log(0,"Test","hello world !");
        require_once "Vue/Shop/Element.php";
    }

}