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

    /**
     * Liest einen Beitrag mithilfe des Titels aus.
     * @param $title
     * @return array
     * @throws Exception
     */
    public function readByTitle($title)
    {
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE titel LIKE ?";
        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $title = '%' . $title .'%';
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $title);
        // Das Statement absetzen
        $statement->execute();
        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $rows = array();

        // Ersten Datensatz aus dem Resultat holen
        foreach($result as $row)
        {
            $rows[] = $row;
        }
        // Datenbankressourcen wieder freigeben
        $result->close();
        // Den gefundenen Datensatz zurückgeben
        return $rows;
    }

    /**
     * Liest einen Datensatz mithilfe eines Tags/einer Kategorie aus.
     * @param $continent
     * @return array
     * @throws Exception
     */
    public function readByContinent($continent)
    {
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE kontinent LIKE ?";
        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $continent = '%' . $continent .'%';
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $continent);
        // Das Statement absetzen
        $statement->execute();
        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $rows = array();

        foreach($result as $row)
        {
            $rows[] = $row;
        }
        // Datenbankressourcen wieder freigeben
        $result->close();
        // Den gefundenen Datensatz zurückgeben
        return $rows;
    }
}