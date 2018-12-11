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
        $query = "SELECT * FROM {$this->tableName} WHERE titel = ?";
        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $id);
        // Das Statement absetzen
        $statement->execute();
        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        // Den gefundenen Datensatz zurückgeben
        return $result;
    }
}