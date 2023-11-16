<?php
    // Inclusie van de databaseverbinding en starten van de sessie. 
 include 'components/connection.php';
 session_start();
 // Controleer of de gebruiker is ingelogd en stel $user_id in.
 if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}
	  // Uitloggen als het logout-formulier is ingediend.
	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}
	 // Controleren of de get_id in de queryreeks is ingesteld.
	if (isset($_GET['get_id'])) {
		$get_id = $_GET['get_id'];
	}else{
		$get_id = '';
		header('location:order.php');
	}
	 // Annuleren van een order als het annuleringsformulier is ingediend.
	if (isset($_POST['cancle'])) {
		$update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id=?");
		$update_order->execute(['canceled', $get_id]);
		header('location:order.php');
	}

?>
<!-- Inclusie van de stijlinstellingen. -->
<style type="text/css">
	<?php include 'style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<title>view order</title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<!-- Hoofdcontainer van de pagina. -->
	<div class="main">
		<div class="banner">
			<!-- Bannertitel voor de pagina. -->
			<h1>order detail</h1>
		</div>
		<!-- Navigatietitel voor de pagina. -->
		<div class="title2">
			<a href="home.php">home </a><span>/ order detail</span>
		</div>
		<section class="order-detail">
				<div class="title">
					<img src="img/ddd3.png" class="logo">
					<h1>order detail</h1>
					<!-- Sectie voor het weergeven van orderdetails. -->
					<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam
                    tenetur
                </p> -->
				</div>
				<!-- Container voor het weergeven van orderdetails. -->
				<div class="box-container">
					<?php 
					 // Initialisatie van de totale prijs.
						$grand_total=0;
						 // Query om de details van een specifieke order op te halen.
						$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id=? LIMIT 1");
						$select_orders->execute([$get_id]);
						 // Controleren of er orders zijn gevonden.
						if ($select_orders->rowCount()>0) {
							while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
								$select_product = $conn->prepare("SELECT * FROM `products` WHERE id=? LIMIT 1");
								$select_product->execute([$fetch_order['product_id']]);
								// Berekenen van de subtotale prijs.
								if ($select_product->rowCount()>0) {
									while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
										$sub_total= ($fetch_order['price']* $fetch_order['qty']);
										$grand_total += $sub_total;
									
					?>
					<!-- Container voor het weergeven van de orderdetails en gebruikersinformatie. -->
					<div class="box">
						<div class="col">
							 <!-- Datum, afbeelding, prijs, naam en totale prijs van het product. -->
							<p class="title"><i class="bi bi-calendar-fill"></i><?= $fetch_order['date']; ?></p>
							<img src="image/<?= $fetch_product['image']; ?>" class="image">
							<p class="price"><?= $fetch_product['price']; ?> x <?= $fetch_order['qty']; ?></p>
							<h3 class="name"><?= $fetch_product['name']; ?></h3>
							<p class="grand-total">Total amount payable : <span>$<?= $grand_total; ?></span></p>
						</div>
						<div class="col">
							<!-- Factuuradres en statusinformatie. -->
							<p class="title">billing address</p>
							<p class="user"><i class="bi bi-person-bounding-box"></i><?= $fetch_order['name']; ?></p>
							<p class="user"><i class="bi bi-phone"></i><?= $fetch_order['number']; ?></p>
							<p class="user"><i class="bi bi-envelope"></i><?= $fetch_order['email']; ?></p>
							<p class="user"><i class="bi bi-pin-map-fill"></i><?= $fetch_order['address']; ?></p>
							<p class="title">status</p>
							<!-- Bestel opnieuw knop of annuleer bestelling knop. -->
							<p class="status" style="color:<?php if ($fetch_order['status']=='delevered'){echo 'green';}elseif($fetch_order['status']=='canceled') {echo 'red';}else{echo 'orange';}?>"><?=$fetch_order['status'] ?></p>
							<?php if ($fetch_order['status']=='canceled') { ?>
								<a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">order again</a>
							<?php }else{ ?>
								<form method="post">
									<button type="submit" name="cancle" class="btn" onclick="return confirm('do you want to cancel this order')">cancle order</button>
								</form>
							<?php } ?>
						</div>
					</div>
					<?php 
								}
							}else{
								  // Toon een bericht als het product niet is gevonden.
								echo '<p class="empty">product not found</p>';
							}
						}

					}else{
						echo '<p class="empty">no order found</p>';
					}
					?>
				</div>
			
		</section>
		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>
</body>
</html>