<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 10.12.2018
 * Time: 12:06
 */

class profileController
{
    /**
     * Ruft die Funktion profile derselben Klasse auf.
     */
    public function index()
    {
        $this->profile();
    }

    /**
     * Je nachdem, ob der User angemeldet ist oder nicht, wird das Profil oder
     * das Anmeldefenster angezeigt. Falls dieser schon eingelogt ist, werden
     * zusätzlich noch alle erstellten Beiträge dieses Users aus der Datenbank
     * gelesen und im Profil aufgelistet.
     * @throws Exception
     */
    public function profile() {
        if ($_SESSION["isSignedIn"] != null){
            $view = new View('profile');
            $view->title = 'Mein Profil';
            $view->heading = 'Mein Profil';

            require_once ("../repository/BlogRepository.php");
            $blogRepository = new BlogRepository();
            $blogs = $blogRepository->readAllBlogsFromUser($_SESSION["isSignedIn"]);
            $view->blogs = $blogs;
            $view->username = $_SESSION["isSignedIn"];
            $view->display($_SESSION["isSignedIn"]);
        }
        else {
            $_SESSION["isSignedIn"] = null;
            $view = new View('user_login');
            $view->title = 'Login';
            $view->heading = 'Login';
            $view->display($_SESSION["isSignedIn"]);
        }
    }

    /**
     * Erstellt eine neue View, in welcher ein Eintrag gelöscht werden kann.
     */
    public function deleteBlog() {
        $blogId = $_GET['id'];
        $view = new View('deleteBlog');
        $view->title = 'Beitrag löschen';
        $view->heading = 'Beitrag löschen';
        $view->blogID = $blogId;
        $view->display($_SESSION["isSignedIn"]);
    }

    /**
     * Diese Funktion löscht den Eintrag mit der erhaltenen ID aus der Datenbank.
     * @throws Exception
     */
    public function deleteTheBlog() {
        $id = $_POST['id'];
        require_once ("../repository/BlogRepository.php");
        $blogRepository = new BlogRepository();
        $blogRepository->deleteFromBetweenTable($id);
        $blogRepository->deleteFromTable($id);

        require_once ("profileController.php");
        header("Location: /profile/profile");
    }

}