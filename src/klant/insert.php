<?php
// auteur: studentnaam
// functie: insert class Klant

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

		// Code insert klant
	$row = [
		'klantNaam' => $_POST['klantnaam'] ?? '',
		'klantEmail' => $_POST['klantemail'] ?? '',
		'klantPostcode' => $_POST['klantpostcode'] ?? '',
		'klantAdres' => $_POST['klantadres'] ?? '',
		'klantWoonplaats' => $_POST['klantwoonplaats'] ?? ''
	];
	$klant = new Klant;
	$klant->insertKlant($row);

	header("Location: read.php");
	exit;

} 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
	<nav class="nav">
        <img src="../img/Bas.png" alt="bas">
        <a href="read.php">CRUD klant</a>
    </nav>
    <h1></h1>

	<h1>CRUD Klant</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="nv">Klantnaam:</label>
	<input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required/>
	<br>   
	<label for="an">Klantemail:</label>
	<input type="text" id="ke" name="klantemail" placeholder="Klantemail" required/>
	<br>
	   
	<label for="an">Klantpostcode:</label>
	<input type="text" id="kp" name="klantpostcode" placeholder="Klantpostcode" required/>
	<br>
	  
	<label for="an">Klantadres:</label>
	<input type="text" id="ka" name="klantadres" placeholder="Klantadres" required/>
	<br>
	<label for="an">Klantwoonplaats:</label>
	<input type="text" id="kw" name="klantwoonplaats" placeholder="Klantwoonplaats" required/>
	<br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read.php'>Terug</a>

</body>
</html>



