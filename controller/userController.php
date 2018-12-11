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
        $_SESSION["isSignedIn"] = null;
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display($_SESSION["isSignedIn"]);

    }

    public function authenticate(){
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once ("../repository/UserRepository.php");
        $userrepo = new UserRepository();
        $validusername = $userrepo->verify($username, $password);
        if($validusername == $username) {
            $_SESSION["isSignedIn"] = $validusername;
            $view = new View('profile');
            $view->title = 'Mein Profil';
            $view->heading = 'Mein Profil';
            $view->username = htmlspecialchars($validusername);
            $view->display($_SESSION["isSignedIn"]);
        }
        else {
            $_SESSION["isSignedIn"] = null;
            $view = new View('user_login');
            $view->title = 'Login';
            $view->heading = 'Login';
            if ($validusername)
                $view->validation = $validusername;
            $view->display($_SESSION["isSignedIn"]);

        }
    }
    public function logout() {
        $_SESSION["isSignedIn"] = null;
        $view = new View('default_index');
        $view->title = 'Startseite';
        $view->heading = 'Startseite';
        $view->display($_SESSION["isSignedIn"]);
    }


    public function create()
    {
        $_SESSION["isSignedIn"] = null;
        $view = new View('user_register');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display($_SESSION["isSignedIn"]);
    }
    public function save(){
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once ("../repository/UserRepository.php");
        $userRepository = new UserRepository();
        $userRepository->create($username, $email, $password);

        $view = new View('profile');
        $view->title = 'Mein Profil';
        $view->heading = 'Mein Profil';

        $_SESSION["isSignedIn"] = htmlspecialchars($username);
        $view->username = $username;
        $view->display($_SESSION["isSignedIn"]);
    }
}