<?php
/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 04.12.2018
 * Time: 11:01
 */
class Dispatcher
{
    /**
     * Diese Methode wertet die Request URI aus leitet die Anfrage entsprechend
     * weiter.
     */

    public static function dispatch()
    {
        global $isSignedIn;

        // Die URI wird aus dem $_SERVER Array ausgelesen und in ihre Einzelteile zerlegt.
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');
        $uri = trim($uri, '/');
        $uriFragments = explode('/', $uri);

        // Den Namen des gewünschten Controllers ermitteln
        $controllerName = 'DefaultController';
        if (!empty($uriFragments[0])) {
            $controllerName = $uriFragments[0];
            $controllerName = ucfirst($controllerName);
            $controllerName .= 'Controller';
        }

        // Den Namen der auszuführenden Methode ermitteln
        $method = 'index';
        if (!empty($uriFragments[1])) {
            $method = $uriFragments[1];
        }

        // Den gewünschten Controller laden
        // Falls der Controller nicht existiert, wird DefaultController angezeigt
        if ($_SESSION["isSignedIn"] != null){
        if(file_exists("../controller/$controllerName.php")){
            require_once "../controller/$controllerName.php";

            // Eine neue Instanz des Controllers wird erstellt und die gewünschte
            //   Methode darauf aufgerufen.*/
            $controller = new $controllerName($_SESSION["isSignedIn"]);
            $controller->$method();
            }

        else {
            $controllerName = "DefaultController";
            $method = "index";

            require_once "../controller/$controllerName.php";
            $controller = new $controllerName($_SESSION["isSignedIn"]);
            $controller->$method();
            }
        }
        else{        if(file_exists("../controller/$controllerName.php")){
            require_once "../controller/$controllerName.php";

            // Eine neue Instanz des Controllers wird erstellt und die gewünschte
            //   Methode darauf aufgerufen.*/
            $controller = new $controllerName($_SESSION["isSignedIn"]);
            $controller->$method();
        }

        else {
            $controllerName = "DefaultController";
            $method = "index";

            require_once "../signedInController/$controllerName.php";
            $controller = new $controllerName();
            $controller->$method();
        }

        }
    }
}