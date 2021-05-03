<?php
	/* Template Name: CONTACT */
?>

<html>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://kit.fontawesome.com/2094d2be20.js" crossorigin="anonymous"></script>

	<body>
		<div class="navbar">
		<div class="menu">
			<a href="home.php">Home</a>
			<a href="">Products</a>
			<a href="" class="active">Contact</a>
			<a href="about.php">About Us</a>
		</div>
	</div>

	<div class="search">
		<div class="search-bar">
			<input type="text" name="search" placeholder="Search..">
		</div>
		<div class="my-account">
			<a href=""><label>My Account</label><i class="fas fa-user"></i><i class="fas fa-caret-down"></i></a>|<a href=""><i class="fas fa-shopping-cart"></i><label>Cart</label></a>
		</div>
	</div>

	<div class="container">
		<div class="title">
			<h1>CONTACT US</h1>
			<p>Have questions? We're happy to help you!</p>
		</div>
		<hr>

		<div class="form">
			<div class="form-control">
				<label>Full Name</label>
				<input type="text" name="name">
			</div>
			<div class="form-control">
				<label>Email Address</label>
				<input type="text" name="email">
			</div>
			<div class="form-control">
				<label>Subject</label>
				<input type="text" name="subject">
			</div>
			<div class="form-control">
				<label>Message</label>
				<textarea name="message" rows="4" cols="50"></textarea>
			</div>
			<div class="button">
				<button>SEND</button>
			</div>
		</div>

		<div class="social">
			<table>
				<tr>
					<td><i class="fas fa-map-marker-alt"></i></td>
					<td>ABC Bldg. Aguinaldo Highway, Imus Cavite</td>
				</tr>
				<tr>
					<td><i class="fas fa-phone-alt"></i></td>
					<td>09561234567</td>
				</tr>
				<tr>
					<td><i class="fas fa-envelope"></i></td>
					<td>shoedeckph@gmail.com</td>
				</tr>
			</table>
			<hr>
			<div class="social-medias">
				<a href=""><i class="fab fa-twitter-square"></i></a>
				<a href=""><i class="fab fa-facebook-square"></i></a>
				<a href=""><i class="fab fa-instagram-square"></i></a>
			</div>
			<label><center><b>Shoe Deck</b> on social media</center></label>
		</div>
	</div>
	</body>
</html>