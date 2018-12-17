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

    /**
     * Erstellt einen neuen Datenbankeintrag in der Tabelle beitrag.
     * @param $title
     * @param $tag
     * @param $image
     * @param $text
     * @return mixed
     * @throws Exception
     */
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

    /**
     * Fügt den neu erstellten Beitrag in der Zwischentabelle ein.
     * @param $blogId
     * @param $username
     * @throws Exception
     */
    public function setInBetweenTable($blogId, $username)
    {
        $query = "INSERT INTO {$this->betweenTableName} (fk_benutzername,fk_beitrag_id) VALUES (?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss',$username, $blogId);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    /**
     * Löscht den entsprechenden Datensatz aus der Zwischentabelle.
     * @param $blogID
     * @throws Exception
     */
    public function deleteFromBetweenTable($blogID)
    {
        $query = "DELETE FROM {$this->betweenTableName} where {$this->betweenTableName}.fk_beitrag_id = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s',$blogID);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    /**
     * Löscht den entsprechenden Datensatz aus der Tablle beitrag.
     * @param $blogID
     * @throws Exception
     */
    public function deleteFromTable($blogID)
    {
        $query = "DELETE FROM {$this->tableName} where {$this->tableName}.id = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s',$blogID);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    /**
     * Liest alle Beiträge aus, die von einem bestimmten User erstellt wurden.
     * @param $username
     * @return array
     * @throws Exception
     */
    public function readAllBlogsFromUser($username)
    {
        $query = "SELECT * FROM {$this->tableName} left join {$this->betweenTableName} on {$this->tableName}.id = {$this->betweenTableName}.fk_beitrag_id
         where {$this->betweenTableName}.fk_benutzername = ?";

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

    /**
     * Liest einen Beitrag mithilfe der ID aus.
     * @param $id
     * @return |null
     * @throws Exception
     */
    public function readBlogFromID($id){
        $query = "SELECT {$this->tableName}.titel, {$this->tableName}.kontinent, {$this->tableName}.inhalt FROM {$this->tableName} where {$this->tableName}.id = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $id);

        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $contentItems = null;

        foreach($result as $content)
        {
            $contentItems = $content;
        }

        $result->close();

        return $contentItems;
    }

    /**
     * Aktualisiert einen Beitrag
     * @param $id
     * @param $title
     * @param $tag
     * @param $content
     * @throws Exception
     */
    public function updateBlog($id, $title, $tag, $content){
        $query = "UPDATE {$this->tableName} SET {$this->tableName}.titel = ?, {$this->tableName}.kontinent = ?, {$this->tableName}.inhalt = ? where {$this->tableName}.id = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $title, $tag, $content, $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}