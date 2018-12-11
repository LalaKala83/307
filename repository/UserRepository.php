<?php
/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 10.12.2018
 * Time: 14:03
 */
require_once '../lib/Repository.php';
class UserRepository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'benutzer';
    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param  $username Wert für die Spalte benutzername
     * @param $email Wert für die Spalte email
     * @param $passwort Wert für die Spalte passwort
     *
     * @return insert_id Wert der ID vom eingetragenen User
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($username, $email, $passwort)
    {
        $passwort = password_hash($passwort, PASSWORD_BCRYPT);
        $query = "INSERT INTO $this->tableName (benutzername, email, passwort) VALUES (?, ?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sss',$username, $email, $passwort);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;
    }

    public function verify($passwort, $username){
        $query = "SELECT passwort from $this->tableName where benutzername LIKE ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $username);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        $row = mysqli_fetch_row($result);
        if ($row != false){

            password_verify($passwort, (string)$row);
            return $username;
        }
        else{
            return null;
        }

    }
}