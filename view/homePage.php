<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog Seite</title>
        <link rel="stylesheet" href="../public/css/main.css" />
    </head>
    <body>
		<div class="header">
			<div class="mainTitle">
				<a href="index.php?category="> Blog Seite </a>
			</div>
		<!----------------------- LOGIN PART-------------------------->
			<div class="login">
				<?php if( $loginMessage != "You logged in successfully..." ){   ?>
					<form method="post" action="">
						<input type="hidden" name="loginCheck"></input>
						<p style="font-size:12px; color:red;"><?= "*". $loginMessage;?><p>
						<div class="loginParts">
							<input name="email" type="text" placeholder="Email"></input>
						</div>
						<div class="loginParts">
							<input name="password" type="text" placeholder="Password"></input>
						</div>
						<div class="loginParts">
							<input type="submit" name = "login" value="Login"></input>
						</div>
					</form>
				<?php }else{ ?>
					<div style="width:100%; height:30px; text-align: right;">
						<a style="color:red;  margin-right:5%" href="index.php?checkout=logout">Logout</a><br><!-- br etiketini unutma!!!!!!!!!!!!!!!!!!-->
						<a style="color:red;  margin-right:5%" href="view/dashboard.php">>>Zum Dashboard</a>
					</div>
				<?php } ?>
			</div>
		</div>
		
		<!----------------------- LOGIN PART END-------------------------->
		
		<!----------------------- HEADER CATEGORIES-------------------------->
		
		<div>
			<div class="categories">
				<div class="subCategories">
					<a href="index.php?category=lifestyle">Lifestyle</a>
				</div>
				<div class="subCategories">
					<a href="index.php?category=food">Food</a>
				</div>
				<div class="subCategories">
					<a href="index.php?category=mobile">Mobile</a>
				</div>
				<div class="subCategories">
					<a href="index.php?category=living">Living</a>
				</div>
				<div class="subCategories">
					<a href="index.php?category=sport">Sport</a>
				</div>
			</div>
			
		<!----------------------- HEADER CATEGORIES END-------------------------->
			
			<div class="blogPagesBorder">
				<?php foreach($blogs as $key=>$value): ?>
					<div class="blogPages">
						<p style="text-align:right; margin: 0px; margin-right:5px"> Kategorie:<?=$value['category'];?> </p><br>
						<h3 style="color: red; margin: 5px"> <?=$value['headline'];?> </h3><br>
						<p style="margin:5px; font-size: 14px; color:silver"> Baran Yildiz(Freiburg) schrieb am 24.09.2021 um 07:11 Uhr </p><br>
						<img src="public/img/<?=$value['image_file'];?>" width= "300" height= "150" style="float:left"> 
						<p style="width:100%; word-wrap:break-word; margin-top:0; margin-left:5px;"><?=$value['text'];?></p>
					</div>
				<?php endforeach; ?>
			</div>
			
		</div>
	</body>
</html>