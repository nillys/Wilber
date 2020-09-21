<?php

    if(count(explode("/",$_SERVER['REQUEST_URI'])) >= 4){
        require "../Config/info.db.php";
    }else{

        require "Config/info.db.php";
    }



class DB
{

    static public $pdo;
    private static $inited;

    public static function init_DB($pdo)
    {

        if (self::$inited != 1) {
            
            self::$pdo = $pdo;
            self::$inited = 1;
        }
    }

    static public function pull_data_from_db($table, $field,$value)
    {


        $q = self::$pdo->prepare('SELECT * FROM ' . $table . ' WHERE '. $field . ' = ? ');
        $q->execute([$value]);

        $result = $q->fetch();

        return $result;
    }
}

DB::init_DB($pdo);
