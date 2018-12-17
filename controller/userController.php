<?php
/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 04.12.2018
 * Time: 11:47
 */

class userController
{
    private $validation = null;

    /**
     * Die Funktion leitet die Anfrage durch die header-Funktion an die Funktion
     * create derselben Klasse weiter.
     */
    public function index()
    {
        // Anfrage an die URI /user/create weiterleiten (HTTP 302)
        header('Location: /user/create');
        exit();
    }

    /**
     * Zeigt das Login an.
     */

    public function login(){
        $_SESSION["loggedInUser"] = null;
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display($_SESSION["loggedInUser"]);
    }

    /**
     * Verifiziert die Eingaben beim Login und füllt bei korrekten Eingaben die Session-Variable loggedInUser mit dem angemeldeten User.
     * Bei falschen Eingaben werden diese entsprechend behandelt.
     * @throws Exception
     */
    public function authenticate(){
        $username = $_POST["username"];
        $password = $_POST["password"];

        require ("../repository/UserRepository.php");
        $userrepo = new UserRepository();
        $validusername = $userrepo->verify($username, $password);
        if($validusername == $username) {
            $_SESSION["loggedInUser"] = $validusername;
            require_once ("profileController.php");
            header("Location: /profile/profile");
        }
        else {
            $_SESSION["loggedInUser"] = null;
            $view = new View('user_login');
            $view->title = 'Login';
            $view->heading = 'Login';
            if ($validusername)
                $view->validation = $validusername;
            $view->display($_SESSION["loggedInUser"]);

        }
    }

    /**
     * Logt den User aus. Session-Variable loggedInUser wird auf null gesetzt.
     */
    public function logout() {
        $_SESSION["loggedInUser"] = null;
        $view = new View('default_index');
        $view->title = 'Startseite';
        $view->heading = 'Startseite';
        $view->display($_SESSION["loggedInUser"]);
    }

    /**
     * Zeigt die Registrierung-Seite an.
     */
    public function create()
    {
        $_SESSION["loggedInUser"] = null;
        $view = new View('user_register');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->validation = $this->validation;
        $view->display($_SESSION["loggedInUser"]);
    }

    /**
     * Speichert bei validen Eingaben einen neuen User ein.
     * Bei invalidem Benutzername wird die Registrierungs-Seite mit Validation-Text aufgerufen.
     * @throws Exception
     */
    public function save(){
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        require ("../repository/UserRepository.php");
        $userRepository = new UserRepository();
        if ($userRepository->isUserNameUnique($username)) {
        $userRepository->create($username, $email, $password);

        $view = new View('profile');
        $view->title = 'Mein Profil';
        $view->heading = 'Mein Profil';

        $_SESSION["loggedInUser"] = htmlspecialchars($username);
        $view->username = $username;
        $view->display($_SESSION["loggedInUser"]);
        }
        else {
            $this->validation = "Der Benutzername ist leider schon vergeeben";
            $this->create();
        }
    }

    /**
     * Zeigt die Passwort-Änderungsseite an.
     */
    public function change(){
        $view = new View('user_changePW');
        $view->title = 'Passwort ändern';
        $view->heading = 'Passwort ändern';
        $view->display($_SESSION["loggedInUser"]);
    }

    /**
     * Ändert bei valider Passwort-Eingabe das Passwort, anderfalls wird eine Validierungs-Message angezeigt
     * und auf die Seite "incorrectPW" umgeleitet.
     * @throws Exception
     */
    public function changing(){
        $username = $_SESSION["loggedInUser"];
        $oldPW = $_POST["oldPW"];
        $newPW = $_POST["newPW"];


        require_once ("../repository/UserRepository.php");
        $userRepository = new UserRepository();
        $isCorrect = $userRepository->verifyPW($username, $oldPW);
        if ($isCorrect){
            $userRepository->changePW($username, $newPW);
            require_once ("profileController.php");
            header("Location: /profile/profile");
        }
        else {
            $view = new View('incorrectPW');
            $view->title = 'Passwort inkorrekt';
            $view->heading = 'Passwort inkorrekt';
            $view->display($_SESSION["loggedInUser"]);
        }

    }
}