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
 // Uitloggen als het uitlogformulier is ingediend.
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
	  <!--bootstrap contaction -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<title>order</title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	 <!-- Hoofdcontainer van de pagina. -->
	<div class="main">
		<div class="banner">
			 <!-- Banner voor de pagina. -->
			<h1>my order</h1>
		</div>
		 <!-- Titel en kruimelpad voor de pagina. -->
		<div class="title2">
			<a href="home.php">home </a><span>/ order</span>
		</div>
		<!-- Sectie voor het weergeven van bestellingen. -->
		<section class="orders">
				<div class="title">
					<img src="img/ddd3.png" class="logo">
					<h1>my orders</h1>
					<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam
                    tenetur
                </p> -->
				</div>
				  <!-- Container voor de bestellingen. -->
				<div class="box-container">
					<?php 
					  // Voorbereiden en uitvoeren van de databasequery om bestellingen van de gebruiker op te halen.
						$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
						$select_orders->execute([$user_id]);
						// Controleren of er bestellingen zijn.
						if ($select_orders->rowCount()>0) {
							// Itereren over elke bestelling.
							while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
								$select_products = $conn->prepare("SELECT * FROM `products` WHERE id=?");
								$select_products->execute([$fetch_order['product_id']]);
								 // Controleren of er productgegevens zijn.
								if ($select_products->rowCount()>0) {
									while($fetch_product=$select_products->fetch(PDO::FETCH_ASSOC)){
										  // Itereren over elke productgegevens.
										
					?>
					 <!-- Container voor elke bestelling. Kleur wordt gewijzigd op basis van de bestelstatus. -->
					<div class="box" <?php if($fetch_order['status']=='cancle'){echo 'style="border:2px solid red";';} ?>>
					 <!-- Link naar de gedetailleerde bestellingspagina. -->
						<a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
						<!-- Datum, productafbeelding, naam, prijs, hoeveelheid en status van de bestelling. -->
							<p class="date"><i class="bi bi-calender-fill"></i><span><?=$fetch_order['date']; ?></span></p>
							<img src="image/<?= $fetch_product['image']; ?>" class="image" >
							<div class="row">
								<h3 class="name"><?= $fetch_product['name']; ?></h3>
								<p class="price">Price : $<?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?></p>
								<p class="status" style="color:<?php if($fetch_order['status']=='delivered'){echo 'green';}elseif($fetch_order['status']=='canceled'){echo 'red';}else{echo 'orange';} ?>"><?= $fetch_order['status']; ?></p>
							</div>
						</a>
						
					</div>
					<?php 
									}
								}
							}
						}else{
							echo '<p class="empty">no order takes placed yet!</p>';
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