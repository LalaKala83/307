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

    public function login(){
        $_SESSION["isSignedIn"] = null;
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display($_SESSION["isSignedIn"]);
    }

    public function loginWithValidation($validation){
        $_SESSION["isSignedIn"] = null;
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display($_SESSION["isSignedIn"]);
    }

    public function authenticate(){
        //todo: umleiten auf profile/profile
        $username = $_POST["username"];
        $password = $_POST["password"];

        require ("../repository/UserRepository.php");
        $userrepo = new UserRepository();
        $validusername = $userrepo->verify($username, $password);
        if($validusername == $username) {
            $_SESSION["isSignedIn"] = $validusername;
            $view = new View('profile');
            $view->title = 'Mein Profil';
            $view->heading = 'Mein Profil';

            require_once ("../repository/BlogRepository.php");
            $blogRepository = new BlogRepository();
            $blogs = $blogRepository->readAllBlogsFromUser($_SESSION["isSignedIn"]);
            $view->blogs = $blogs;
            $view->username = htmlspecialchars($validusername);
            $view->display($_SESSION["isSignedIn"]);
            require_once ("profileController.php");
            header("Location: /profile/profile");
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

        require ("../repository/UserRepository.php");
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