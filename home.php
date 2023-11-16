<?php 
// Inclusie van de databaseverbinding
 include 'components/connection.php';
 // Start van de sessie voor gebruikersinformatie
 session_start();
 // Controleer of de gebruiker is ingelogd en wijs $user_id toe
 if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}
// Uitloggen als de 'logout' knop wordt ingedrukt
	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}
?>
<style type="text/css">
	<?php include 'style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>home</title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		
		<section class="home-section">
			<div class="slider">
				<div class="slider__slider slide1">
					<!-- Slidersectie met verschillende dia's -->
					<div class="overlay"></div>
					<div class="slide-detail">
						<!-- <h1>The pinnacle of imagination and magic</h1>
						<p></p>
						<a href="view_products.php" class="btn">shop now</a> -->
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide2">
					<div class="overlay"></div>
					<div class="slide-detail">
						<!-- <h1>welcome to my shop</h1>
						<p></p>
						<a href="view_products.php" class="btn">shop now</a> -->
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide3">
					<div class="overlay"></div>
					<div class="slide-detail">
						<!-- <h1>Let us know everything new and wonderful</h1>
						<p></p>
						<a href="view_products.php" class="btn">shop now</a> -->
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide4">
					<div class="overlay"></div>
					<div class="slide-detail">
						<!-- <h1>A collection of the best Apple laptops in the world</h1>
						<p></p>
						<a href="view_products.php" class="btn">shop now</a> -->
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide5">
					<div class="overlay"></div>
					<div class="slide-detail">
						<!-- <h1>APPLE WATCH</h1>
						<p></p>
						<a href="view_products.php" class="btn">shop now</a> -->
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="left-arrow"><i class='bx bxs-left-arrow'></i></div>
                <div class="right-arrow"><i class='bx bxs-right-arrow'></i></div>
			</div>
		</section>
		<!-- home slider end -->
		<section class="thumb">
			<!-- Deze foto's geven een indruk van de producten die deze site aanbiedt . -->
			<div class="box-container">
				<div class="box">
					<img src="img/ns1.png">
					<h3>All smartphones</h3>
					<p>Discover our diverse laptops for every need.</p>
					<!-- <i class="bx bx-chevron-right"></i> -->
				</div>
				<div class="box">
					<img src="img/ns2.png">
					<h3>All labtops</h3>
					<p>Discover our full range of laptops.</p>
					<!-- <i class="bx bx-chevron-right"></i> -->
				</div>
				<div class="box">
					<img src="img/ns4.png">
					<h3>The best audio	</h3>
					<p>Pure sound. Wireless freedom.</p>
					<!-- <i class="bx bx-chevron-right"></i> -->
				</div>
				<div class="box">
					<img src="img/vsn8.png">
					<h3>All watchs</h3>
					<p>Explore our full watch collection.</p>
					<!-- <i class="bx bx-chevron-right"></i> -->
				</div>
			</div>
		</section>
		<section class="container">
			<div class="box-container">
				<div class="box">
					<img src="img/flash-sale 2.png">
				</div>
				<!-- Beste offer die deze website aanbied voor labtops en Smartphons . -->
				<div class="box">
					<img src="img/ns2.png">
					<span>Best Offer for gaming laptops</span>
					<h1>Save up to 50% off</h1>
					<p>Get ready for action with our 50% off gaming laptop! Unleash the power of high-performance gaming with cutting-edge features and graphics. Don't miss this limited-time offer for an immersive gaming experience.</p>
				</div>
			</div>
		</section>
		<section class="shop">
			<div class="title">
				<img src="img/ns1.png">
				<h1>Trending Products</h1>
			</div>
			<div class="row">
				<img src="img/unnamed 2.png">
				<div class="row-detail">
					<img src="img/abna3.jpg">
					<div class="top-footer">
						<h1>Innovative technology at your fingertips.</h1>
					</div>
				</div>
			</div>
			<!-- Deze foto's geven een indruk van de producten die deze site aanbiedt . -->
			<div class="box-container">
				<div class="box">
					<img src="img/maxx.jpg">
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="box">
					<img src="img/msiijpg.jpg">
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="box">
					<img src="img/tbok.jpg">
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="box">
					<img src="img/watje2jpg.jpg">
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="box">
					<img src="img/buds1.jpg">
					<a href="view_products.php" class="btn">shop now</a>
				</div>
				<div class="box">
					<img src="img/applelab.jpg">
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
		</section>
		<section class="shop-category">
			<div class="box-container">
				<div class="box">
					<!-- Servise section . -->
					<img src="img/chara3.jpg">
					<div class="detail">
						<span>BIG OFFERS</span>
						<h1>Extra 15% off</h1>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
				</div>
				<div class="box">
					<img src="img/NNZ.jpg">
					<div class="detail">
						<span>NEW ACCESSORIES</span>
						<h1>GET IT</h1>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
				</div>
			</div>
		</section>
		<section class="services">
			<div class="box-container">
				<div class="box">
					<img src="img/icon2.png">
					<div class="detail">
						<h3>great savings</h3>
						<p>save big every order</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon1.png">
					<div class="detail">
						<h3>24*7 support</h3>
						<p>one-on-one support</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon0.png">
					<div class="detail">
						<h3>gift vouchers</h3>
						<p>vouchers on every festivals</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon.png">
					<div class="detail">
						<h3>worldwide delivery</h3>
						<p>dropship worldwide</p>
					</div>
				</div>
			</div>
		</section>
		<!--Logo van de producten die wij verkopen -->
		<section class="brand">
			<div class="box-container">
				<div class="box">
					<img src="img/A3.png">
				</div>
				<div class="box">
					<img src="img/b3.png">
				</div>
				<div class="box">
					<img src="img/c3.png">
				</div>
				<div class="box">
					<img src="img/d3.png">
				</div>
				<div class="box">
					<img src="img/e3.png">
				</div>
			</div>
		</section>
		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>
</body>
</html>