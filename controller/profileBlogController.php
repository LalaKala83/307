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
        }
    }

    public function createTheBlog()
    {
        $title = $_POST["title"];
        $tag = $_POST["tags"];
        $picture = $_POST["fileToUpload"];
        $textarea = $_POST["blog"];

        $view = new View('profile');
        $view->title = 'Mein Profil';
        $view->heading = 'Mein Profil';
        $view->username = $_SESSION["isSignedIn"];
        $view->display($_SESSION["isSignedIn"]);
    }
}