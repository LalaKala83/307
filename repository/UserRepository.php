<?php
/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 10.12.2018
 * Time: 14:03
 */
require_once '../lib/Repository.php';
class UserRepository extends Repository
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


    public function verifyPW($username, $passwort){
        $query = "SELECT passwort FROM {$this->tableName} WHERE benutzername LIKE ?";
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $username);
        // Das Statement absetzen
        $statement->execute();
        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_array();
        if ($row !== null)
        {
            if (password_verify($passwort, reset($row)))
            { return true; }
        }
        return false;
    }

    public function changePW($username, $passwort){
        $passwort = password_hash($passwort, PASSWORD_BCRYPT);
        $query = "UPDATE {$this->tableName} SET {$this->tableName}.passwort = ? WHERE benutzername = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss', $passwort, $username);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
    public function verify($username, $passwort){
        // Query erstellen
        $query = "SELECT passwort FROM {$this->tableName} WHERE benutzername LIKE ?";
        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $username);
        // Das Statement absetzen
        $statement->execute();
        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_array();
        if ($row !== null)
        {
            if (password_verify($passwort, reset($row)))
            { return $username; }
            else {
                return "Passwort ungültig";
            }
        }

        else {
            return "Benutzername ungültig";
        }

    }

    public function isUserNameUnique($title)
    {
        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE benutzername LIKE ?";
        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $title);
        // Das Statement absetzen
        $statement->execute();
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_array();
        if($row !== null) {
            return false;
        }
        else {
            return true;
        }
    }
}