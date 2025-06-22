<?php
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $row = [
        'artOmschrijving' => $_POST['artOmschrijving'] ?? '',
        'artInkoop' => $_POST['artInkoop'] ?? '',
        'artVoorraad' => $_POST['artVoorraad'] ?? '',
        'artMinVoorraad' => $_POST['artMinVoorraad'] ?? '',
        'artMaxVoorraad' => $_POST['artMaxVoorraad'] ?? '',
        'artLocatie' => $_POST['artLocatie'] ?? ''
    ];
    $artikel = new Artikel;
    $artikel->insertArtikel($row);
    header("Location: readArt.php");
    exit;
}
?>
<form method="post">
    <input type="text" name="artOmschrijving" placeholder="Omschrijving" required><br>
    <input type="number" step="0.01" name="artInkoop" placeholder="Inkoop" required><br>
    <input type="number" name="artVoorraad" placeholder="Voorraad" required><br>
    <input type="number" name="artMinVoorraad" placeholder="Min Voorraad" required><br>
    <input type="number" name="artMaxVoorraad" placeholder="Max Voorraad" required><br>
    <input type="number" name="artLocatie" placeholder="Locatie" required><br>
    <input type="submit" name="insert" value="Toevoegen">
</form>
<a href="readArt.php">Terug</a>