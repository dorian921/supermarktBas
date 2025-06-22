<?php
namespace Bas\classes;

use Bas\classes\Database;

include_once "functions.php";

class Artikel extends Database
{

  private $table_name = "artikelen";

  public function CRUDartikel(): void {
        // Haal alle artikelen op uit de database mbv de method getArtikelen()
        $lijst = $this->getArtikelen();

        // Print een HTML tabel van de lijst
        $this->showTable($lijst);
    }
    public function getArtikelen(): array {
        $sql = "SELECT artId, artOmschrijving, artInkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getArtikel(int $artId): array {
        $sql = "SELECT artId, artOmschrijving, artInkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie FROM $this->table_name WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['artId' => $artId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];
    }

    public function insertArtikel($row): bool {
        $sql = "INSERT INTO $this->table_name (artOmschrijving, artInkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
                VALUES (:artOmschrijving, :artInkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'artOmschrijving' => $row['artOmschrijving'],
            'artInkoop' => $row['artInkoop'],
            'artVoorraad' => $row['artVoorraad'],
            'artMinVoorraad' => $row['artMinVoorraad'],
            'artMaxVoorraad' => $row['artMaxVoorraad'],
            'artLocatie' => $row['artLocatie']
        ]);
    }

    public function updateArtikel($row): bool {
        $sql = "UPDATE $this->table_name SET
                    artOmschrijving = :artOmschrijving,
                    artInkoop = :artInkoop,
                    artVoorraad = :artVoorraad,
                    artMinVoorraad = :artMinVoorraad,
                    artMaxVoorraad = :artMaxVoorraad,
                    artLocatie = :artLocatie
                WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'artOmschrijving' => $row['artOmschrijving'],
            'artInkoop' => $row['artInkoop'],
            'artVoorraad' => $row['artVoorraad'],
            'artMinVoorraad' => $row['artMinVoorraad'],
            'artMaxVoorraad' => $row['artMaxVoorraad'],
            'artLocatie' => $row['artLocatie'],
            'artId' => $row['artId']
        ]);
    }

    public function deleteArtikel(int $artId): bool {

       $sqlVerkoop = "DELETE FROM verkooporder WHERE artId = :artId";
        $stmtVerkoop = self::$conn->prepare($sqlVerkoop);
        $stmtVerkoop->execute(['artId' => $artId]);
        
        $sql = "DELETE FROM $this->table_name WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(['artId' => $artId]);
    }

    public function showTable($lijst): void {
        $txt = "<table>";
        $txt .= "<tr>
            <th>artOmschrijving</th><th>artInkoop</th><th>artVoorraad</th>
            <th>artMinVoorraad</th><th>artMaxVoorraad</th><th>artLocatie</th><th>Wijzig</th><th>Verwijder</th>
        </tr>";
        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td hidden>{$row['artId']}</td>";
            $txt .= "<td>{$row['artOmschrijving']}</td>";
            $txt .= "<td>{$row['artInkoop']}</td>";
            $txt .= "<td>{$row['artVoorraad']}</td>";
            $txt .= "<td>{$row['artMinVoorraad']}</td>";
            $txt .= "<td>{$row['artMaxVoorraad']}</td>";
            $txt .= "<td>{$row['artLocatie']}</td>";
            $txt .= "<td>
                <form method='post' action='updateArt.php?artId={$row['artId']}'>
                    <button name='update'>Wzg</button>
                </form>
            </td>";
            $txt .= "<td>
                <form method='post' action='deleteArt.php'>
                    <input type='hidden' name='artId' value='{$row['artId']}'>
                    <button name='verwijderen'>Verwijderen</button>
                </form>
            </td>";
            $txt .= "<td>
                <form method='post' action='insertArt.php'>
                    <input type='hidden' name='artId' value='{$row['artId']}'>
                    <button name='toevoegen'>toevoegen</button>
                </form>
            </td>";
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }
}