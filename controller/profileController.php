<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 10.12.2018
 * Time: 12:06
 */

class profileController
{

    public function index()
    {
        $this->profile();
    }

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
}