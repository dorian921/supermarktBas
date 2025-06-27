<?php
require '../../vendor/autoload.php';
use Bas\classes\Verkooporder;

$verkooporder = new Verkooporder;
$lijst = $verkooporder->getVerkooporders();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>verkooporders overzicht</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav class="nav">
        <img src="../img/Bas.png" alt="bas">
        <a href="klant/read.php">CRUD klant</a>
        <a href="artikelen/readArt.php">CRUD artikelen</a>
        <a href="inkooporder/readinkooporder.php">verkooporders CRUD</a>
    </nav>
    <h1>verkooporders</h1>
    <a href="insertVerkooporder.php">Nieuwe verkooporder toevoegen</a>
    <?php
        $verkooporder->showTable($lijst);
    ?>
</body>
</html>