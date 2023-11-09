<?php 
 include 'components/connection.php';
 session_start();
 if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}

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
	<title>about</title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>about us</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ about</span>
		</div>
		<div class="about-category">
			<div class="box">
				<img src="image/2k.jpg">
				<div class="detail">
					<!-- <span>APPLE</span>
					<h1>Iphone14 pro</h1> -->
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="image/iphone 15rpo max.png">
				<div class="detail">
					<!-- <span>coffee</span>
					<h1>lemon Teaname</h1> -->
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="image/SAMSUNG Galaxy Buds2 Pro Grijs.png">
				<div class="detail">
					<!-- <span>coffee</span>
					<h1>lemon Teaname</h1> -->
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="image/APPLE AirPods 3e generatie Lightning Charging (2022).jpg">
				<div class="detail">
					<!-- <span>coffee</span>
					<h1>lemon green</h1> -->
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
		</div>
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
		<div class="about">
			<div class="row">
				<div class="img-box">
					<img src="img/ezgif.com-webp-to-png.png">
				</div>
				<div class="detail">
    		<h1>AR Mobile Webshop - Your Gateway to the Ultimate Tech Experience!</h1>
    		<p>Welcome to AR Mobile Webshop, your one-stop destination for the latest in technology and innovation.</p>
    		<p>Our digital haven offers a curated selection of top-tier products, including iPhones, Samsung devices, AirPods, Watches, and Laptops, all designed to elevate your digital lifestyle.</p>
    		<p>Discover the future in your pocket with our range of iPhones and Samsung smartphones, or immerse yourself in the world of wireless audio with AirPods that redefine your audio experience.</p>
    		<p>Stay connected and stylish with our selection of Watches, and power up your productivity with cutting-edge Laptops.</p>
    		<p>At AR Mobile Webshop, we're committed to delivering top-notch tech solutions to your doorstep.</p>
    		<p>Explore the history of innovation, and embark on a journey to elevate your tech game. Shop with us today and experience the future, one device at a time.</p>
    		<a href="view_products.php" class="btn">Shop Now</a>
			</div>

			</div>
		</div>
		<div class="testimonial-container">
			<div class="title">
				<img src="img/ddd3.png" class="logo">
				<h1>what people say about us</h1>
				<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam
                    tenetur
                </p> -->
            </div>
                <div class="container">
                	<div class="testimonial-item active">
                		<img src="img/01.jpg">
                		<h1>sara smith</h1>
                		<p>Outstanding service and top-quality products!</p>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/02.jpg">
                		<h1>john smith</h1>
                		<p>The best tech shopping experience ever!</p>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/03.jpg">
                		<h1>selena ansari</h1>
                		<p>AR Mobile Webshop delivers excellence every time.</p>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/04.png">
                		<h1>alweena ansari</h1>
                		<p>Fast shipping and unbeatable prices.</p>
                	</div>
                	<div class="left-arrow" onclick="nextSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
                	<div class="right-arrow" onclick="prevSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
                </div>
		</div>
		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<script type="text/javascript">
		let slides = document.querySelectorAll('.testimonial-item');
		let index = 0;

		function nextSlide(){
		    slides[index].classList.remove('active');
		    index = (index + 1) % slides.length;
		    slides[index].classList.add('active');
		}
		function prevSlide(){
		    slides[index].classList.remove('active');
		    index = (index - 1 + slides.length) % slides.length;
		    slides[index].classList.add('active');
		}
	</script>
	<?php include 'components/alert.php'; ?>
</body>
</html>