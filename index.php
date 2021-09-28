<?php

$loginMessage 	= "";
echo "server request method : " . $_SERVER["REQUEST_METHOD"];
require_once  "config/config.php";
require_once  "model/dBConnection.php";
require_once  "model/blogModel.php";
require_once  "model/userModel.php";
$dB             = new dBConnection(serverName, user, password);
$pdo            = $dB->connect();

/************Getting URL for Fetching Data from Database*************/

if( empty($_GET) ){

	/*********************Fetching All Data from Database*****************/

	/****************Fetching All Data from Database End*****************/

}elseif( ( isset($_GET['category']) && $_GET['category'] != "" ) ){



}elseif( ( isset($_GET['checkout']) && $_GET['checkout'] != "" ) ) {

	$checkout   = trim(htmlspecialchars($_GET['checkout'], ENT_QUOTES));
	if($checkout === "logout"){

	}



}else{
	header("Location:index.php");
	exit;
}



/*****************Hashing Login Passwords****************
$password = 1234;
$passwordHash = password_hash($password,PASSWORD_DEFAULT);
echo $passwordHash; echo "<br>";

$password = 12345;
$passwordHash = password_hash($password,PASSWORD_DEFAULT);
echo $passwordHash; echo "<br>";

 ********************************************************/

/*echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
if( isset( $_POST['loginCheck'] ) ){

	/*echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    */


}


/*
	$ = "red";

	switch ($favcolor) {
		case "red":
			echo "Your favorite color is red!";
			break;
		case "blue":
			echo "Your favorite color is blue!";
			break;
		case "green":
			echo "Your favorite color is green!";
			break;
		default:
			echo "Your favorite color is neither red, blue, nor green!";
}
*/
	//Blog Site Main Page...
	$url    = $_SERVER["REQUEST_URI"];
	$method = $_SERVER["REQUEST_METHOD"];

	if(strpos($url, '?')){
		$uArr = explode('?', $url);
	}else{
		$uArr = [null,null];
	}


	if( $method == "GET" && ($url == "/" || $url == "/index.php" || $_GET['category'] == "" ) ) {

        $blogs = blogController::getAllBlogs();
        require_once "view/homePage.php";

    }elseif($method == "GET" && ( isset($_GET['category']) && $_GET['category'] != "" )){

        $category 	    =  trim(htmlspecialchars($_GET['category'], ENT_QUOTES));
        $blogModel      =  new blogModel($category);
        $blogController =  new blogController($blogModel);
        $blogs          =  $blogController->getCatBlogs();

	}elseif($method == "POST" && isset($_POST["loginCheck"] )  ){
        $email 			= trim(htmlspecialchars($_POST['email'], ENT_QUOTES));
        $password 		= trim(htmlspecialchars($_POST['password'], ENT_QUOTES));

        $userMod        = new userModel($email,$password);
        $userCont       = new userController($userMod);
        $loginMessage 	= $userCont->checkLogin();


    }elseif ($url == "/dashboard.php" || $uArr[0] == "/dashboard.php"){
		require_once "view/dashboard.php";
	}



	if(strpos($url, '?')){
		$uArr = explode('?', $url);
	}else{
		$uArr = [null,null];
	}

	




