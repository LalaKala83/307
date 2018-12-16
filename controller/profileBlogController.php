<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 11.12.2018
 * Time: 10:53
 */

class profileBlogController
{
    public function createBlog()
    {
        $view = new View('createNewBlog');
        $view->title = 'Beitrag erfassen';
        $view->heading = 'Beitrag erfassen';
        $view->blogTitle = '';
        $view->blogContent = '';
        $view->selectedTag = 'Andere';
        $view->buttonValue = 'Beitrag erstellen';
        $view->blogID = '0';
        $view->action = '/profileBlog/createTheBlog';
        $view->username = $_SESSION["isSignedIn"];
        $view->display($_SESSION["isSignedIn"]);
    }

    public function createTheBlog()
    {
        $title = $_POST["title"];
        $tag = $_POST["tags"];
        $image = $_POST["fileToUpload"];
        $text = $_POST["blog"];

        require_once ("../repository/BlogRepository.php");
        $blogRepository = new BlogRepository();
        $id = $blogRepository->create($title, $tag, $image, $text);
        $blogRepository->setInBetweenTable($id, $_SESSION["isSignedIn"]);

        require_once ("profileController.php");
        header("Location: /profile/profile");
    }
}