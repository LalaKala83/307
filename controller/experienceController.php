<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 10.12.2018
 * Time: 08:38
 */

class experienceController
{
    /**
     * Leitet die Anfrag auf die Methode search der Klasse entryController weiter.
     */
    public function index()
    {
        // Anfrage an die URI /user/search weiterleiten (HTTP 302)
        header('Location: /entry/search');
        exit();
    }

    /**
     * Erstellt eine neue View zum Entdecken von Beiträgen.
     */
    public function experience() {
        $view = new View('experience');
        $view->title = 'Entdecken';
        $view->heading = 'Entdecken';
        $view->display($_SESSION["isSignedIn"]);
    }

    /**
     *Die Funktion zeigt einen bestimmten Entry an.
     *Es wird auf die Klasse EntryRepository zugegriffen, welche
     *Datensätze aus der Datenbank liest.
     * @throws Exception
     */
    public function show(){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');
        $uri = trim($uri, '/');
        $uriFragments = explode('/', $uri);
        $important = end($uriFragments);

        $continent = $this->getContinent($important);

        require_once ("../repository/EntryRepository.php");
        $entryRepo = new EntryRepository();
        $result =  $entryRepo->readByContinent($continent);


        $view = new View('experience_continent');
        $view->title = $continent;
        $view->heading = $continent;
        $view->result = $result;
        $view->display($_SESSION["isSignedIn"]);
    }

    /**
     * Gibt je nach Inhalt der Variable continent einen anderen
     * String zurück.
     * @param $continent
     * @return string
     */
    private function getContinent($continent){
        switch ($continent){
            case "na":
                return "Nordamerika";
                break;
            case "sa":
                return "Südamerika";
            case "africa":
                return "Afrika";
            case  "europe":
                return "Europa";
            case "asia":
                return "Asien";
            case "antarctis":
                return "Antarktis";
            case "oceania":
                return "Ozeanien";
            case "australia":
                return "Australien";
            default:
                return "Andere";
        }
    }
}