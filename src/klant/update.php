<?php
    // auteur: studentnaam
    // functie: update class Klant

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\Klant;
    
    $klant = new Klant;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen" ){

        // Code voor een update

        $row = [
            'klantId' => $_POST['klantId']   ,
            'klantNaam' => $_POST['klantNaam'] ,
            'klantEmail' => $_POST['klantEmail'],
            'klantPostcode' => $_POST['klantPostcode'],
            'klantAdres' => $_POST['klantAdres'] ,
            'klantWoonplaats' => $_POST['klantWoonplaats'] 
        ];

        $klant->updateKlant($row);
        
        $row = $klant->getKlant($_POST['klantId']);
    } 
    elseif (isset($_GET['klantId'])){
        $row = $klant->getKlant($_GET['klantId']);
        
    } else {
        echo "Geen klantId opgegeven<br>";
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css"<?php echo time(); ?>>
</head>
<body>
    
<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>	
<nav class="nav">
        <img src="../img/Bas.png" alt="bas">
        <a href="read.php">CRUD klant</a>
    </nav>
    <h1></h1>
<form method="post">
<input type="hidden" name="klantId" 
    value="<?php if(isset($row['klantId'])) { echo $row['klantId']; } ?>">

<input type="text" name="klantWoonplaats" required
    value="<?php if(isset($row['klantWoonplaats'])) {echo $row['klantWoonplaats']; }?>"> </br>

    <input type="text" name="klantPostcode" required
    value="<?php if(isset($row['klantPostcode'])) {echo $row['klantPostcode']; }?>"> </br>

<input type="text" name="klantAdres" required
    value="<?php if(isset($row['klantAdres'])) {echo $row['klantAdres']; }?>"> </br>
<input type="text" name="klantNaam" required 
    value="<?php if(isset($row['klantNaam'])) {echo $row['klantNaam']; }?>"> </br>
<input type="text" name="klantEmail" required 
    value="<?php if(isset($row['klantEmail'])) {echo $row['klantEmail']; }?>"> </br></br>
<input type="submit" name="update" value="Wijzigen">
</form></br>

<a href="read.php">Terug</a>

</body>
</html>