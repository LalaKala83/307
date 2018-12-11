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
        $query = "INSERT INTO $this->tableName (titel, inhalt, kontinent) VALUES (?, ?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sss',$title, $text, $tag);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;
    }

    protected $betweenTableName = 'beitrag_user';

    public function setInBetweenTable($blogId, $username)
    {
        $query = "INSERT INTO $this->betweenTableName (fk_uname,fk_bid) VALUES (?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss',$username, $blogId);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function readAllBlogsFromUser($username)
    {
        $query = "SELECT * FROM {$this->tableName} left join {$this->betweenTableName} on {$this->tableName}.id = {$this->betweenTableName}.fk_bid
         where fk_uname = ?";

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