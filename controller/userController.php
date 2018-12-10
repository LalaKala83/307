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

        header('Location: /user/login');
        exit();

        header('Location: /user/authenticate');
        exit();
    }

    public function login(){
        $_SESSION["isSignedIn"] = false;
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display($_SESSION["isSignedIn"]);

    }

    public function authenticate(){
        $username = $_POST["username"];
        $password = $_POST["password"];


        password_verify($password, )
    }
    public function logout() {
        $_SESSION["isSignedIn"] = false;
        $view = new View('default_index');
        $view->title = 'Startseite';
        $view->heading = 'Startseite';
        $view->display($_SESSION["isSignedIn"]);
    }


    public function create()
    {
        global $isSignedIn;
        $view = new View('user_register');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display($_SESSION["isSignedIn"]);
    }
    public function save(){
        global $isSignedIn;
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once ("../repository/UserRepository.php");
        $userRepository = new UserRepository();
        $userRepository->create($username, $email, $password);

        $view = new View('profile');
        $view->title = 'Mein Profil';
        $view->heading = 'Mein Profil';

        $_SESSION["isSignedIn"] = true;
        $view->display($_SESSION["isSignedIn"]);
    }
}