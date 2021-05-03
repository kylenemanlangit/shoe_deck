<?php
	/* Template Name: HOME */
?>

<html>
<script src="https://kit.fontawesome.com/2094d2be20.js" crossorigin="anonymous"></script>

<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

	*{
	  box-sizing: border-box;
	}

	body{
	  font-family: 'Montserrat', sans-serif;
	  margin:0;
	  padding:0;
	  background-color: #c8d4d2;
	}

	.navbar {
	  background-image: url("http://localhost/wordpress/wp-content/uploads/2021/05/logo-2.png");
	  background-size: 130px;
	  background-repeat: no-repeat;
	  height: 130px;
	  background-color: #282a29;
	}

	.navbar a {
	  border-radius: 10px;
	  display:inline-block;
	  font-size: 20px;
	  color: #ebebeb;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	  margin-top:40px;
	}

	.menu{
	  float:right;
	}

	.navbar a:hover{
	  background-color: #adadad;
	  color: #282a29;
	}

	.navbar a.active{
	  background-color: #adadad;
	  color: #282a29;
	}

	.navbar .icon {
	  display: none;
	}

	.banner{
	  border:1px solid black;
	  width:100%;
	}

	.banner a:nth-child(even){
	  float:right;
	}

	.banner img{
	  width:100%;
	  height:auto;
	}

	.shoes{
	  text-align: center;
	  margin-bottom: 20px;
	}

	.shoes img{
	  width:24%;
	  height:auto;
	}
</style>

<body>
	<div class="navbar">
		<div class="menu">
			<a href="">Home</a>
			<a href="http://localhost/wordpress/shop/">Products</a>
			<a href="http://localhost/wordpress/contact/">Contact</a>
			<a href="http://localhost/wordpress/about/">About Us</a>
		</div>
	</div>

	<div class="banner">
		<img src="http://localhost/wordpress/wp-content/uploads/2021/04/banner-scaled.jpg">
	</div>

	<h2>Brands</h2>
	<div class="shoes">
		<a href="http://localhost/wordpress/shop"><img src="http://localhost/wordpress/wp-content/uploads/2021/04/adidas-1.jpg"></a>
		<a href="http://localhost/wordpress/shop"><img src="http://localhost/wordpress/wp-content/uploads/2021/04/nike.jpg"></a>
		<a href="http://localhost/wordpress/shop"><img src="http://localhost/wordpress/wp-content/uploads/2021/04/skechers.jpg"></a>
		<a href="http://localhost/wordpress/shop"><img src="http://localhost/wordpress/wp-content/uploads/2021/04/converse.jpg"></a>
	</div>
</body>
</html>