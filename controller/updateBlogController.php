<?php
/**
 * Created by PhpStorm.
 * User: nyro
 * Date: 16.12.2018
 * Time: 12:09
 */

class updateBlogController
{
    /**
     * Erstellt eine neue View zum aktualisieren eines Eintrages und
     * übergibt der View dazu die Usereingaben, die dieser beim Erstellen
     * des Blogs betätigt hat. Diese liest er mithilfe der Beitrags-Id aus
     * der Datenbank.
     * @throws Exception
     */
    public function updateBlog() {
        $blogId = $_GET['id'];

        require_once ("../repository/BlogRepository.php");
        $blogRepository = new BlogRepository();
        $blogItems = $blogRepository->readBlogFromID($blogId);

        $view = new View('createNewBlog');
        $view->title = 'Beitrag aktualisieren';
        $view->heading = 'Beitrag aktualisieren';
        $view->username = $_SESSION["loggedInUser"];
        $view->blogTitle = $blogItems["titel"];
        $view->blogContent = $blogItems["inhalt"];
        $view->selectedTag = $blogItems["kontinent"];
        $view->blogID = $blogId;
        $view->buttonValue = 'Beitrag aktualisieren';
        $view->action = '/updateBlog/updateTheBlog';
        $view->display($_SESSION["loggedInUser"]);
    }

    /**
     * Erhält die Usereingaben und aktualisiert mithilfe von diesen den bereits
     * erstellten Blog.
     * @throws Exception
     */
    public function updateTheBlog() {
        $title = $_POST["title"];
        $tag = $_POST["tags"];
        $image = $_POST["fileToUpload"];
        $text = $_POST["blog"];
        $blogId = $_POST["id"];

        require_once ("../repository/BlogRepository.php");
        $blogRepository = new BlogRepository();
        $blogRepository->updateBlog($blogId, $title, $tag, $text);

        require_once ("profileController.php");
        header("Location: /profile/profile");
    }
}