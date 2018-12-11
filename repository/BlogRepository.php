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
}