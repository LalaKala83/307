<?php
/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 11.12.2018
 * Time: 13:16
 */


require_once '../lib/Repository.php';
class EntryRepository extends Repository
{
    protected $tableName = 'beitrag';


    public function readById($id)
    {
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE titel LIKE ?";
        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $id = '%' . $id .'%';
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $id);
        // Das Statement absetzen
        $statement->execute();
        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        // Den gefundenen Datensatz zurückgeben
        return $rows;
    }
}