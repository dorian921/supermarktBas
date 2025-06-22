<?php
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel;

if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {
    $row = [
        'artId' => $_POST['artId'],
        'artOmschrijving' => $_POST['artOmschrijving'],
        'artInkoop' => $_POST['artInkoop'],
        'artVoorraad' => $_POST['artVoorraad'],
        'artMinVoorraad' => $_POST['artMinVoorraad'],
        'artMaxVoorraad' => $_POST['artMaxVoorraad'],
        'artLocatie' => $_POST['artLocatie']
    ];
    $artikel->updateArtikel($row);
    $row = $artikel->getArtikel($_POST['artId']);
} elseif (isset($_GET['artId'])) {
    $row = $artikel->getArtikel($_GET['artId']);
} else {
    echo "Geen artId opgegeven<br>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form method="post">
    <input type="hidden" name="artId" value="<?php echo($row['artId']); ?>">
    <input type="text" name="artOmschrijving" value="<?php echo ($row['artOmschrijving']); ?>" required><br>
    <input type="number" step="0.01" name="artInkoop" value="<?php echo ($row['artInkoop']); ?>" required><br>
    <input type="number" name="artVoorraad" value="<?php echo ($row['artVoorraad']); ?>" required><br>
    <input type="number" name="artMinVoorraad" value="<?php echo ($row['artMinVoorraad']); ?>" required><br>
    <input type="number" name="artMaxVoorraad" value="<?php echo ($row['artMaxVoorraad']); ?>" required><br>
    <input type="number" name="artLocatie" value="<?php echo($row['artLocatie']); ?>" required><br>
    <input type="submit" name="update" value="Wijzigen">
</form>
<a href="readArt.php">Terug</a>
</body>
</html>
