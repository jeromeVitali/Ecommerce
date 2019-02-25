<?php

	session_start();

	try{

		$db = new PDO('mysql:host=localhost;dbname=ecommerce', 'root','');
		$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractères minuscules
		$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
		$db->exec('SET NAMES utf8');				
	}

	catch(Exception $e){

		die('Veuillez vérifier la connexion à la base de données');

	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" type="text/css" media="screen" href="style/bootstrap.css">
        <link rel="stylesheet" type="text/css" media="screen" href="style/perso.css">
	</head>
	<header>
		<br/><h1>Site E-Commerce</h1><br/>
		<ul class="menu">
			<li><a href="index.php">Accueil</a></li>
			<li><a href="boutique.php">Boutique</a></li>
			<li><a href="panier.php">Panier</a></li>
			<li><a href="conditions_generales_de_vente.php">Conditions Generales de Vente</a></li>
		</ul>
	</header>
</html>
