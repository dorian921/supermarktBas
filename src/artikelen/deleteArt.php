<?php
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

if (isset($_POST["verwijderen"])) {
    $artId = (int)$_POST['artId'];
    if (empty($artId)) {
        echo '<script>alert("Geen artId opgegeven")</script>';
        echo "<script> location.replace('readArt.php'); </script>";
        exit;
    }

    elseif ($artId == true){
    $artikel = new Artikel;
    $artikel->deleteArtikel($artId);
    echo '<script>alert("Artikel verwijderd")</script>';
    echo "<script> location.replace('readArt.php'); </script>";
  }

}