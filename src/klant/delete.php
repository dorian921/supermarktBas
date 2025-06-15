<?php 
// auteur: dorian
// functie: 

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["verwijderen"])){
	
	// Maak een object Klant
	$klant = new Klant;
	// Haal de klantId op uit de POST
	$klantId = (int)$_GET['klantId'];
	if($klantId == null) {
		echo '<script>alert("Geen klantId opgegeven")</script>';
		echo "<script> location.replace('read.php'); </script>";
		exit;
	}

	// Delete Klant op basis van NR
	if($klantId == true){
	$klant->deleteKlant($klantId);
	}
	echo '<script>alert("Klant verwijderd")</script>';
	echo "<script> location.replace('read.php'); </script>";
}
?>



