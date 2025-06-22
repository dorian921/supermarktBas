<?php
// auteur: dorian
// functie: definitie class Klant
namespace Bas\classes;

use Bas\classes\Database;

include_once "functions.php";

class Klant extends Database{
	public $klantId;
	public $klantemail = null;
	public $klantnaam;

	public $klantpostcode;
	
	public $klantwoonplaats;
	private $table_name = "Klant";	

	// Methods
	
	/**
	 * Summary of crudKlant
	 * @return void
	 */
	public function crudKlant() : void {
		// Haal alle klant op uit de database mbv de method getKlant()
		$lijst = $this->getKlanten();

		// Print een HTML tabel van de lijst	
		$this->showTable($lijst);
	}

	/**
	 * Summary of getKlant
	 * @return mixed
	 */
	public function getKlanten() : array {
		// Haal alle klanten op uit de database
		$sql = "SELECT klantId, klantNaam, klantEmail, klantPostcode, klantAdres, klantWoonplaats FROM $this->table_name";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

 /**
  * Summary of getKlant
  * @param int $klantId
  * @return mixed
  */
	public function getKlant(int $klantId) : array {

		// Doe een fetch op $klantId
		$sql = "SELECT klantId,klantNaam, klantEmail, klantPostcode, klantAdres, klantWoonplaats FROM $this->table_name WHERE klantId = :klantId";	
		$stmt = self::$conn->prepare($sql);
		$stmt->execute(['klantId' => $klantId]);
		return $stmt->fetch(\PDO::FETCH_ASSOC)?: [];
	}
	
	public function dropDownKlant($row_selected = -1){
	
		// Haal alle klanten op uit de database mbv de method getKlanten()
		$lijst = $this->getKlanten();
		
		echo "<label for='Klant'>Choose a klant:</label>";
		echo "<select name='klantId'>";
		foreach ($lijst as $row){
			if($row_selected == $row["klantId"]){
				echo "<option value='$row[klantId]' selected='selected'> $row[klantnaam] $row[klantemail]</option>\n";
			} else {
				echo "<option value='$row[klantId]'> $row[klantnaam] $row[klantemail]</option>\n";
			}
		}
		echo "</select>";
	}

 /**
  * Summary of showTable
  * @param mixed $lijst
  * @return void
  */
	public function showTable($lijst) : void {

		

		$txt = "<table>";

		// Voeg de kolomnamen boven de tabel
		$txt .= getTableHeader($lijst[0]);

		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td>" . $row["klantId"] . "</td>";
			$txt .=  "<td>" . $row["klantNaam"] . "</td>";
			$txt .=  "<td>" . $row["klantEmail"] . "</td>";
			$txt .=  "<td>" . $row["klantWoonplaats"] . "</td>";
			$txt .= "<td>" .  $row["klantPostcode"] . "</td>";
			$txt .= "<td>" .  $row["klantAdres"] . "</td>";
			

			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='update.php?klantId=$row[klantId]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";

			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='delete.php?klantId=$row[klantId]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			

			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='insert.php?klantId=$row[klantId]' >       
                <button name='toevoegen'>Toevoegen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete klant
 /**
  * Summary of deleteKlant
  * @param int $klantId
  * @return bool
  */
	public function deleteKlant(int $klantId) : bool {
		// query
		$sql = "DELETE FROM $this->table_name WHERE klantId = :klantId";
		$stmt = self::$conn->prepare($sql);
    return $stmt->execute(['klantId' => $klantId]);

		
		

	}

	public function updateKlant($row) : bool{

		// query
		$sql = "UPDATE $this->table_name 
				SET klantEmail = :klantEmail, klantNaam = :klantNaam, 
					klantPostcode = :klantPostcode, klantAdres = :klantAdres, 
					klantWoonplaats = :klantWoonplaats
				WHERE klantId = :klantId";

		$stmt = self::$conn->prepare($sql);

		return $stmt->execute([
			'klantEmail' => $row['klantEmail'],
			'klantNaam' => $row['klantNaam'],
			'klantPostcode' => $row['klantPostcode'],
			'klantAdres' => $row['klantAdres'],
			'klantWoonplaats' => $row['klantWoonplaats'],
			'klantId' => $row['klantId']
		]);
	}


	/**
	 * Summary of BepMaxKlantId
	 * @return int
	 */
	private function BepMaxKlantId() : int {
		
	// Bepaal uniek nummer
	$sql="SELECT MAX(klantId)+1 FROM $this->table_name";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	
	/**
	 * Summary of insertKlant
	 * @param mixed $row
	 * @return mixed
	 */
	public function insertKlant($row ){
		
		// Bepaal een unieke klantId
		$klantId = $this->BepMaxKlantId();
		

		// query
		$sql = "INSERT INTO $this->table_name (klantId, klantEmail, klantNaam, klantPostcode, klantAdres, klantWoonplaats) 
				VALUES (:klantId, :klantEmail, :klantNaam, :klantPostcode, :klantAdres, :klantWoonplaats)";



		// Prepare
		$stmt = self::$conn->prepare($sql);

		// Execute
		return $stmt->execute([
			'klantId' => $klantId,
			'klantEmail' => $row['klantEmail'],
			'klantNaam' => $row['klantNaam'],
			'klantPostcode' => $row['klantPostcode'],
			'klantAdres' => $row['klantAdres'],
			'klantWoonplaats' => $row['klantWoonplaats']
		]);
	}
}
?>