<?php
/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 04.12.2018
 * Time: 11:47
 */

class userController
{
    public function index()
    {
        // Anfrage an die URI /user/create weiterleiten (HTTP 302)
        header('Location: /user/create');
        exit();
    }

    public function create()
    {
        $view = new View('user_form');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display();
    }
    public function save(){
        /*require_once "../view/user_form.php";
        $email = _POST["email"];
        $username = _POST["username"];
        $password = _POST["password"];
        echo $email . " " .$username. " ". $password;

        $view = new View('user_form');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display();*/
    }
}