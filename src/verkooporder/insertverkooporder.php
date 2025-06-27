<?php
require '../../vendor/autoload.php';
use Bas\classes\Verkooporder;

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $row = [
        'klantId' => $_POST['klantId'] ?? '',
        'artId' => $_POST['artId'] ?? '',
        'verkOrdDatum' => $_POST['verkOrdDatum'] ?? '',
        'verkOrdBestAantal' => $_POST['verkOrdBestAantal'] ?? '',
        'verkOrdStatus' => $_POST['verkOrdStatus'] ?? ''
    ];
    $verkooporder = new Verkooporder;
    $verkooporder->insertVerkooporder($row);
    header("Location: readVerkooporder.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder toevoegen</title>
</head>
<body>
    <h1>Verkooporder toevoegen</h1>
    <form method="post">
        Klant ID: <input type="number" name="klantId" required><br>
        Artikel ID: <input type="number" name="artId" required><br>
        Datum: <input type="date" name="verkOrdDatum" required><br>
        Bestel Aantal: <input type="number" name="verkOrdBestAantal" required><br>
        Status: <input type="text" name="verkOrdStatus" required><br>
        <input type="submit" name="insert" value="Toevoegen">
    </form>
    <a href="readVerkooporder.php">Terug</a>
</body>
</html>