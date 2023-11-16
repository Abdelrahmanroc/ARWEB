<?php
 // Inclusie van de databaseverbinding en starten van de sessie. 
	include 'components/connection.php';
	session_start();
  // Controleren of de gebruiker is ingelogd en instellen van $user_id.
	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}

	//register user
	 // Registratie van de gebruiker als het inlogformulier is ingediend.
	if (isset($_POST['submit'])) {
  // Ontvangen en filteren van de ingediende e-mail en wachtwoord.
		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$pass = $_POST['pass'];
		$pass = filter_var($pass, FILTER_SANITIZE_STRING);
		 // Voorbereiden en uitvoeren van de databasequery om de gebruiker te selecteren.

		$select_user = $conn->prepare("SELECT * FROM `users` WHERE  email = ? AND password = ?");
		$select_user->execute([$email, $pass]);
		$row = $select_user->fetch(PDO::FETCH_ASSOC);
		 // Controleren of de gebruiker is gevonden.
		if ($select_user->rowCount() > 0) {
			 // Sessievariabelen instellen voor de ingelogde gebruiker en doorverwijzen naar de startpagina.
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['user_name'] = $row['name'];
			$_SESSION['user_email'] = $row['email'];
			header('location: home.php');
		}else{
			 // Foutmelding als de gebruiker niet is gevonden.
			$warning_msg[] = 'incorrect username or password';
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
	<title>login</title>
</head>
<body>
	 <!-- Hoofdcontainer voor de loginpagina. -->
	<div class="main-container">
		<section class="form-container">
			<div class="title">
				<img src="img/ddd3.png">
				<h1>login now</h1>
				<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam
                    tenetur
                </p> -->
				 <!-- Een optionele paragraaf die momenteel is uitgeschakeld. -->
			</div>
			<form action="" method="post">
				<div class="input-field">
					<p>your email <sup>*</sup></p>
					<input type="email" name="email" required placeholder="enter your email" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				<div class="input-field">
					<p>your passwod <sup>*</sup></p>
					<input type="password" name="pass" required placeholder="enter your passwod" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				
				<input type="submit" name="submit" value="login now" class="btn">
				<p>do not have an account? <a href="register.php">register now</a></p>
			</form>
		</section>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<?php include 'components/alert.php'; ?>
</body>
</html>