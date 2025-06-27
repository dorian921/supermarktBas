<?php

namespace Bas\classes;

class Verkooporder extends Database
{
    protected string $table_name = 'verkooporder';

    public function getVerkooporders(): array {
        $sql = "SELECT verkOrdId, klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertVerkooporder($row): bool {
        $sql = "INSERT INTO $this->table_name (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
                VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'klantId' => $row['klantId'],
            'artId' => $row['artId'],
            'verkOrdDatum' => $row['verkOrdDatum'],
            'verkOrdBestAantal' => $row['verkOrdBestAantal'],
            'verkOrdStatus' => $row['verkOrdStatus']
        ]);
    }

    public function showTable($lijst): void {
        $txt = "<table border='1'>";
        $txt .= "<tr>
            <th>verkOrdId</th>
            <th>klantId</th>
            <th>artId</th>
            <th>verkOrdDatum</th>
            <th>verkOrdBestAantal</th>
            <th>verkOrdStatus</th>
        </tr>";
        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>{$row['verkOrdId']}</td>";
            $txt .= "<td>{$row['klantId']}</td>";
            $txt .= "<td>{$row['artId']}</td>";
            $txt .= "<td>{$row['verkOrdDatum']}</td>";
            $txt .= "<td>{$row['verkOrdBestAantal']}</td>";
            $txt .= "<td>{$row['verkOrdStatus']}</td>";
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }}