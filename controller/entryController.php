<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 04.12.2018
 * Time: 15:46
 */

class entryController
{
    /**
     * Die Funktion leitet die Anfrage durch die header-Funktion an die Funktion
     * search derselben Klasse weiter.
     */
    public function index()
    {
        // Anfrage an die URI /entry/search weiterleiten (HTTP 302)
        header('Location: /entry/search');
        exit();
    }

    /**
     * Die View, wo die Suche dargestellt wird, wird mit den entsprechenden Informationen
     * dargestellt.
     */
    public function search() {
            $view = new View('search');
            $view->title = 'Eintrag suchen';
            $view->heading = 'Eintrag suchen';
            $view->display($_SESSION["isSignedIn"]);
    }

    /**
     *Die Funktion zeigt einen bestimmten Entry an.
     * Es wird auf die Klasse EntryRepository zugegriffen, welche
     * Datensätze aus der Datenbank liest.
     * @throws Exception
     */
    public function show(){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');
        $uri = trim($uri, '/');
        $uriFragments = explode('/', $uri);
        $important = end($uriFragments);

        require_once ("../repository/EntryRepository.php");
        $entryRepo = new EntryRepository();
        $result =  $entryRepo->readById($important);

        $view = new View('entry_alone');
        $view->title = $result["titel"];
        $view->blog = $result;
        $view->display($_SESSION["isSignedIn"]);

    }

    /**
     * Die Funktion liest die Datensätze aus der Datenbank, die der Suchanfrage entsprechen
     * und gibt die Ergebnisse in einer neuen View aus.
     * @throws Exception
     */
    public function find() {
        $title = $_POST['title'];
        require_once ("../repository/EntryRepository.php");
        $entryRepo = new EntryRepository();
        $result =  $entryRepo->readByTitle($title);

        $view = new View('entry_found');
        $view->title = 'Gefundene Einträge';
        $view->heading = 'Gefundene Einträge';
        $view->result = $result;
        $view->display($_SESSION["isSignedIn"]);
    }
}