<?php
// Databaseconfiguratie 
	$db_name = 'mysql:host=localhost;dbname=shop_db'; // Hier wordt de naam van de database opgegeven, met het type en de locatie van de database.
	$db_user = 'root';// Gebruikersnaam voor de databaseverbinding.
	$db_password ='';// Wachtwoord voor de databaseverbinding.

	$conn = new PDO($db_name,$db_user,$db_password);

	// Functie voor het genereren van een unieke ID
	function unique_id(){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charLength = strlen($chars);
		$randomString = '';
		for ($i=0; $i < 20 ; $i++) { 
			$randomString.=$chars[mt_rand(0, $charLength - 1)];
		}
		return $randomString;
	}
?>