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

        header('Location: /user/save');
        exit();
    }

    public function create()
    {
        global $isSignedIn;
        $view = new View('user_form');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display($isSignedIn);
    }
    public function save(){
        global $isSignedIn;
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $isSignedIn = true;

        $view = new View('profile');
        $view->title = 'Mein Profil';
        $view->heading = 'Mein Profil';
        $view->display($isSignedIn);
    }
}