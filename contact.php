<?php 
// Inclusie van de databaseverbinding
include 'components/connection.php';
session_start();

// Initialisatie van $user_id
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

// Uitloggen
if (isset($_POST['logout'])) {
	session_destroy();
	header('location: login.php');
}

// Controleer of het berichtformulier is ingediend
if (isset($_POST['submit-btn'])) {
	// Het verkrijgen van ingediende gegevens en zorgen voor een fallback als de waarde leeg is
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$number = isset($_POST['number']) ? $_POST['number'] : '';
	$message = isset($_POST['message']) ? $_POST['message'] : '';
	// Controleer of alle velden zijn ingevuld
	if (!empty($name) && !empty($email) && !empty($number) && !empty($message)) {
		try {
			// Voeg het bericht toe aan de database
			$insert_message = $conn->prepare("INSERT INTO `message` (name, email, number, message) VALUES (?, ?, ?, ?)");
			$insert_message->execute([$name, $email, $number, $message]);
			// Toon een SweetAlert melding met het succesbericht
			$success_msg = "Your message has been sent successfully!";
			echo "<script>
			  window.onload = function() {
				Swal.fire({
				  icon: 'success',
				  title: 'Message Sent!',
				  text: 'Thank you for contacting us. We will get back to you as soon as possible.',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK'
				}).then((result) => {
				  if (result.isConfirmed) {
				    window.location.href = 'contact.php';
				  }
				})
			 };
			</script>";
		} catch (PDOException $e) {
			// Toon een SweetAlert melding met de foutmelding
			echo "<script>
			  window.onload = function() {
				Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: 'An error occurred while sending the message. Please try again later.',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK'
				}).then((result) => {
				  if (result.isConfirmed) {
				    window.location.href = 'contact.php';
				  }
				})
			 };
			</script>";
		}
	} else {
		$warning_msg[] = 'All fields are required';
	}
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
	<title>Contact</title>
</head>
<body>
	<?php include 'components/header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>Contact Us</h1>
		</div>
		<div class="title2">
			<a href="home.php">Home </a><span>/ Contact Us</span>
		</div>
		<section class="services">
			<div class="box-container">
				<div class="box">
					<!-- Sectie met services -->
					<img src="img/icon2.png">
					<div class="detail">
						<h3>Great Savings</h3>
						<p>Save big on every order</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon1.png">
					<div class="detail">
						<h3>24*7 Support</h3>
						<p>One-on-one support</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon0.png">
					<div class="detail">
						<h3>Gift Vouchers</h3>
						<p>Vouchers on every festival</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon.png">
					<div class="detail">
						<h3>Worldwide Delivery</h3>
						<p>Dropship worldwide</p>
					</div>
				</div>
			</div>
		</section>
		<div class="form-container">
			<form method="post">
				<div class="title">
					<!-- Formulier voor het achterlaten van een bericht -->
					<img src="img/ddd3.png" class="logo">
					<h1>Leave a Message</h1>
				</div>
				<div class="input-field">
					<p>Your Name <sup>*</sup></p>
					<input type="text" name="name">
				</div>
				<div class="input-field">
					<p>Your Email <sup>*</sup></p>
					<input type="email" name="email">
				</div>
				<div class="input-field">
					<p>Your Number <sup>*</sup></p>
					<input type="text" name="number">
				</div>
				<div class="input-field">
					<p>Your Message <sup>*</sup></p>
					<textarea name="message"></textarea>
				</div>
				<input type="submit" name="submit-btn" class="btn" value="Send Message">
			</form>
		</div>
		<div class="address">
			<div class="title">
				<img src="img/ddd3.png" class="logo">
				<h1>Contact Detail</h1>
			</div>
			<div class="box-container">
				<div class="box">
					<i class="bx bxs-map-pin"></i>
					<div>
						<h4>Address</h4>
						<p>1092 Merigold Lane, Coral Way</p>
					</div>
				</div>
				<div class="box">
					<i class="bx bxs-phone-call"></i>
					<div>
						<h4>Phone Number</h4>
						<p>8866889955</p>
					</div>
				</div>
				<div class="box">
					<i class="bx bxs-map-pin"></i>
					<div>
						<h4>Email</h4>
						<p>2118018@talnet.nl</p>
					</div>
				</div>
			</div>
		</div>
		<?php if(isset($warning_msg) || isset($success_msg)): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        <?php if(isset($warning_msg)): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: '<?php echo implode("<br>", $warning_msg); ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php elseif(isset($success_msg)): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                html: '<?php echo implode("<br>", $success_msg); ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>
<?php endif; ?>

		<?php include 'components/footer.php'; ?>
	</div>
</body>
</html>