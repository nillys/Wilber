<?php

class database {

    static public $pdo;

    public function __construct(){
        require "../config.db.php";
        self::$pdo = $pdo;
    }

}