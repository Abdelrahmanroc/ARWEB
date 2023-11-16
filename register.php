<?php 
	include 'components/connection.php';
	// Inclusie van de databaseverbinding en starten van de sessie.
	session_start();
	// Controleer of de gebruiker is ingelogd en stel $user_id in.

	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}

	//register user
	// Registratie van de gebruiker als het registratieformulier is ingediend.
	if (isset($_POST['submit'])) {
		// Genereren van een unieke gebruikers-ID.
		$id = unique_id();
		  // Ophalen van ingevoerde gegevens en filteren.
		$name = $_POST['name'];
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$pass = $_POST['pass'];
		$pass = filter_var($pass, FILTER_SANITIZE_STRING);
		$cpass = $_POST['cpass'];
		$cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
		 // Controleren of het opgegeven e-mailadres al bestaat in de database.
		$select_user = $conn->prepare("SELECT * FROM `users` WHERE  email = ?");
		$select_user->execute([$email]);
		$row = $select_user->fetch(PDO::FETCH_ASSOC);
		  // Als het e-mailadres al bestaat, toon een waarschuwingsbericht.	
		if ($select_user->rowCount() > 0) {
			$warning_msg[] = 'email already exist';
		}else{
			 // Als de wachtwoorden overeenkomen, voeg de gebruiker toe aan de database.
			if($pass != $cpass){
				$warning_msg[] = 'confirm your password';
				
			}else{
				 // Voorbereiden en uitvoeren van de databasequery om de gebruiker toe te voegen.
				$insert_user = $conn->prepare("INSERT INTO `users`(id,name,email,password) VALUES(?,?,?,?)");
				$insert_user->execute([$id,$name,$email,$pass]);
				// Doorsturen naar de homepagina na registratie.
				header('location: home.php');
				 // Opnieuw inloggen van de geregistreerde gebruiker.
				$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
				$select_user->execute([$email, $pass]);
				$row = $select_user->fetch(PDO::FETCH_ASSOC);
				// Als de gebruiker is gevonden, stel de sessievariabelen in.
				if ($select_user->rowCount() > 0) {
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['user_name'] = $row['name'];
					$_SESSION['user_email'] = $row['email'];
				}
			}
		}
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
	<title>register</title>
</head>
<body>
	    <!-- Hoofdcontainer van de pagina. -->
	<div class="main-container">
		<section class="form-container">
			<div class="title">
				<img src="img/ddd3.png">
				<h1>register now</h1>
				<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus veniam
                    tenetur
                </p> -->
			</div>
			<form action="" method="post">
				<div class="input-field">
					<p>your name <sup>*</sup></p>
					<input type="text" name="name" required placeholder="enter your name" maxlength="50">
				</div>
				<div class="input-field">
					<p>your email <sup>*</sup></p>
					<input type="email" name="email" required placeholder="enter your email" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				<div class="input-field">
					<p>your passwod <sup>*</sup></p>
					<input type="password" name="pass" required placeholder="enter your passwod" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				<div class="input-field">
					<p>confirm passwod <sup>*</sup></p>
					<input type="password" name="cpass" required placeholder="enter your passwod" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				<input type="submit" name="submit" value="register now" class="btn">
				<p>already have an account? <a href="login.php">login now</a></p>
				  <!-- Knop om het registratieformulier in te dienen. -->
			</form>
		</section>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<?php include 'components/alert.php'; ?>
</body>
</html>