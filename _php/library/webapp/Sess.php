<?php

class AppSess {
    public static $p = array();
    public static function set($index,$value) {
        self::$p[$index]=$value;
        $_SESSION[Project::$name][$index]=$value;
    }
    public static function start() {
        self::$p = isset($_SESSION[Project::$name])?$_SESSION[Project::$name]:array();
    }
}
