<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 11.12.2018
 * Time: 13:09
 */
require_once '../lib/Repository.php';
class BlogRepository extends Repository
{
    protected $tableName = 'beitrag';

    public function create($title, $tag, $image, $text)
    {
        $query = "INSERT INTO {$this->tableName} (titel, inhalt, kontinent) VALUES (?, ?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sss',$title, $text, $tag);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;
    }

    protected $betweenTableName = 'beitrag_benutzer';

    public function setInBetweenTable($blogId, $username)
    {
        $query = "INSERT INTO {$this->betweenTableName} (fk_benutzername,fk_beitrag_id) VALUES (?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss',$username, $blogId);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function deleteFromBetweenTable($blogID)
    {
        $query = "DELETE FROM {$this->betweenTableName} where {$this->betweenTableName}.fk_beitrag_id = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s',$blogID);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function deleteFromTable($blogID)
    {
        $query = "DELETE FROM {$this->tableName} where {$this->tableName}.id = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s',$blogID);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }


    public function readAllBlogsFromUser($username)
    {
        $query = "SELECT * FROM {$this->tableName} left join {$this->betweenTableName} on {$this->tableName}.id = {$this->betweenTableName}.fk_beitrag_id
         where {$this->betweenTableName}.fk_benutzername = ?";

        //$query = "SELECT * FROM beitrag left join beitrag_benutzer on beitrag.id = beitrag_benutzer.fk_beitrag_id WHERE beitrag_benutzer.fk_benutzername = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $username);

        // Das Statement absetzen
        $statement->execute();
        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $rows = array();

        // Ersten Datensatz aus dem Reultat holen
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