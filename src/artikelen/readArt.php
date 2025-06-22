<!--
	Auteur: dorian
	Function: home page CRUD Klant
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css"<?php echo time(); ?>>
</head>

<body>
	<nav class="nav">
        <img src="../img/Bas.png" alt="bas">
        <a href="../Klant/read.php">CRUD klant</a>
        <a href="readArt.php">CRUD artikel</a>   
    </nav>
	<h1>CRUD artikel</h1>
	<nav>
		<a href='../index.html'>Home</a><br>
		
	</nav>
	
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\Artikel;

// Maak een object Klant
$artikel = new Artikel;


// Start CRUD
$artikel->CRUDartikel();

?>
</body>
</html>