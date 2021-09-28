<?php


        $catName            = NULL;
        $categories         = NULL;
        $blog_cat           = NULL;

        /***********************Mysql Connection******************************/
        $servername         = "localhost";
        $username           = "root";
        $password           = "";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        /*********************Mysql Connection End*****************************/

        if( isset($_POST['catCheck']) ){

            $catName        =  trim(htmlspecialchars($_POST['catName'], ENT_QUOTES));
            $sql            =  " INSERT INTO categories(cat_name) VALUES (?)";
            $stmt 	        =  $pdo->prepare($sql);
            $stmt	        -> execute([$catName]);
        }
            $sql            = "SELECT * FROM categories";
            $stmt 	        =  $pdo->prepare($sql);
            $stmt	        -> execute();
            $categories     =  $stmt->fetchAll();

        if( isset($_POST['formsent']) ){

            /*************************** Upload the Image ****************************/
            print_r($_FILES);
            $target_dir     = "../public/img/";
            $target_file    = $target_dir . basename($_FILES["blogImage"]["name"]);
            $uploadOk       = 1;
            $imageFileType  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["blogImage"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            /************ Check if file already exists***********/
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

// Check file size
            if ($_FILES["blogImage"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

// Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["blogImage"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["blogImage"]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            $blog_cat       =  trim(htmlspecialchars($_POST['blogtypes'], ENT_QUOTES));
            $blog_headline  =  trim(htmlspecialchars($_POST['headline'], ENT_QUOTES));
            $blog_text      =  trim(htmlspecialchars($_POST['blogtext'], ENT_QUOTES));
            $blog_imgPath   =  basename($_FILES["blogImage"]["name"]);
            $sql            =  "INSERT INTO blogs (category, headline, image_file, text) VALUES (?, ?, ?, ?)";
            $stmt           =  $pdo->prepare($sql);
            $stmt           -> execute([$blog_cat, $blog_headline, $blog_imgPath, $blog_text]);

        }
?>



<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Blog Site</title>
        <link rel="stylesheet" href="../public/css/main.css" />
    </head>

    <body style="margin-top:50px">
		<div style="width:100%; height:30px; text-align: right;">
			<a style="color:red;  margin-right:5%" href="logout">Logout</a><br><!-- br etiketini unutma!!!!!!!!!!!!!!!!!!-->
			<a style="color:red;  margin-right:5%" href="zumfrontend">Zum Frontend</a>
		</div>
		<div style="width:48%; height:600px; margin-top:50px; float:left">
			<div style="width:100%; height:100px">
				<div style="width:100%; height:50px; float:left;">
					<h1> Blog Seite - Dashboard </h1>
				</div>
				<div style="width:100%; height:20px; float:left; margin-left:5%">
					<h4> Aktiver Benutzer...........: </h4>
				</div>
			</div>
			<div style="width:100%; height:500px; margin-top:30px">
				<div style="width:100%; height:50px; float:left; margin-top:2%; margin-bottom:2%; margin-left:5%">
					<h3 style="color:silver"> Neuen Blog-Eintrag Verfassen </h3>
				</div>
                <form enctype="multipart/form-data" method="post">
                    <input type="hidden" name="formsent"></input>
                    <div style="width:100%; height:20px; float:left; margin-top:2%; margin-bottom:2%; margin-left:5%">
                        <label for="blogtypes">Choose a Blog-Type:</label>
                        <select style= "width:100px"name="blogtypes" id="blogtypes">
                          <?php foreach ($categories as $key=>$value ){ ?>
                              <option value='<?= $value['cat_name'] ?>'><?= $value['cat_name'] ?></option>
                          <?php } ?>
                        </select>
                    </div>
                    <div style="width:100%; height:40px; float:left; margin-top:2%; margin-bottom:2%; margin-left:5%">
                        <input name="headline" style="width:230px; height: 20px;" type="text" placeholder="Überschrift"></input><br>
                    </div><br>
                    <div style="width:100%; height:100px; float:left; margin-top:2%; margin-bottom:2%; margin-left:5%">
                        <textarea id="blogtext" name="blogtext" rows="10" cols="50" placeholder="Blogtext"></textarea><br>
                    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <div style="width:230px; height:20px; float:left; margin-left:5%; margin-top: 5px">
                        <input type="file" id="myFile" name="blogImage"></input><br>
                        <input style ="margin-top:25px;" type="submit" name="blog_submit" value="Send"></input>
                    </div>
                </form>
			</div>
		</div>
		<div style="width:48%; height:600px; margin-top:50px;float:left">
			<div style="width:100%; height:100px;">
				<div style="width:100%; height:50px; float:left;">
					
				</div>
				<div style="width:100%; height:20px; float:left; margin-left:5%">
					
				</div>
			</div>
			<div style="width:100%; height:500px; margin-top:30px">
				<div style="width:100%; height:50px; float:left; margin-left:5%">
					<h3 style="color:silver"> Neue Kategorie Anlegen </h3>
				</div>
                <form method="post">
                    <input type="hidden" name="catCheck"></input>
                    <div style="width:100%; height:20px; float:left; margin-left:5%">
                        <input style="width:230px" name="catName" type="text" placeholder="Name der Kategorie"></input>
                    </div>
                    <div style="width:100%; height:20px; float:left; margin-left:5%; margin-top: 5px">
                        <input style="width:240px; height:30px" type="submit" name="submit" placeholder="Neue Kategorie Anlegen"></input>
                    </div>
                </form>
			</div>
		</div>
	</body>
</html>
			