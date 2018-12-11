<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 10.12.2018
 * Time: 12:06
 */

class profileController
{
    public function profile() {
        $view = new View('profile');
        $view->title = 'Mein Profil';
        $view->heading = 'Mein Profil';
        $view->username = $_SESSION["isSignedIn"];
        $view->display($_SESSION["isSignedIn"]);
    }
}