<?php

class userController{
    private $userModel;

    public function __construct($userModel = NULL){
        $this->userModel = $userModel;
    }

    public function checkLogin(){
        return $this->userModel->checkLogin();
    }

}
