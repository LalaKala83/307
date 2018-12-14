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
        if ($_SESSION["isSignedIn"] != null) {
            $view = new View('createNewBlog');
            $view->title = 'Beitrag erfassen';
            $view->heading = 'Beitrag erfassen';
            $view->username = $_SESSION["isSignedIn"];
            $view->display($_SESSION["isSignedIn"]);
        } else {
            $_SESSION["isSignedIn"] = null;
            $view = new View('user_login');
            $view->title = 'Login';
            $view->heading = 'Login';
            $view->display($_SESSION["isSignedIn"]);
            $bla = array("sew",2,3);
        }
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
        $profilcontroller = new profileController();
        $profilcontroller->index();
    }
}