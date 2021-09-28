<?php

class blogModel{

    public $category;

    function __construct($category=NULL){
        $this->category = $category;
    }

    public static function getAllBlogs(){
        $sql            = "SELECT * FROM blogs";
        $pdo            = self::dBConnect();
        $stmt           = $pdo->prepare($sql);
        $stmt           ->execute();
        return            $stmt->fetchAll();
    }

    public function getCatBlogs(){
        $sql 		    = "SELECT * FROM blogs WHERE category= ?";
        $pdo            = self::dBConnect();
        $stmt 		    = $pdo->prepare($sql);
        $stmt		    ->execute([$this->category]);
        return            $stmt->fetchAll();
    }

    public static function dBConnect(){
        $dB             = new dBConnection(serverName, user, password);
        $pdo            = $dB->connect();
        return $pdo;
    }


}