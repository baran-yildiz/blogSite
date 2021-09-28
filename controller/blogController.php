<?php

class blogController{

    private $blogModel;
    private $userModel;

    function __construct( $blogModel=NULL, $userModel=NULL ){
        $this->userModel = $userModel;
        $this->blogModel = $blogModel;
    }

    public static function getAllBlogs(){
        return blogModel::getAllBlogs();
    }

    public function getCatBlogs(){
        return $this->blogModel->getCatBlogs();
    }

}
