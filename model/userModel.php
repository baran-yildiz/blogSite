<?php

class userModel{
    private $email;
    private $pwd;

    function __construct($email,$pwd){
        $this->email = $email;
        $this->pwd   = $pwd;
    }

    public function checkLogin(){
        $pdo            =  self::dBConnect();
        $sql 			= "SELECT * FROM users ";
        $stmt 			=  $pdo->prepare($sql);
        $stmt       	-> execute();
        $loginMessage 	= "Login error....!!!!";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if( ($row['email'] == $this->email) && ( password_verify( $this->pwd, $row['pwd'] ) ) ){
                $loginMessage = "You logged in successfully...";
            }
        }
        return $loginMessage;
    }

    public static function dBConnect(){
        $dB             = new dBConnection(serverName, user, password);
        return          $dB->connect();
    }

}
