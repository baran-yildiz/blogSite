<?php

class dBConnection{
    private $servername;
    private $username;
    private $password;

    function __construct($server, $user, $pwd){
        $this->servername = $server;
        $this->username   = $user;
        $this->password   = $pwd;
    }

    public function connect(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=blog", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }

}
