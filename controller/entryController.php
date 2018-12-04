<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 04.12.2018
 * Time: 15:46
 */

class entryController
{
    public function index()
    {
        // Anfrage an die URI /user/search weiterleiten (HTTP 302)
        header('Location: /entry/search');
        exit();
    }

    public function search() {
            $view = new View('search');
            $view->title = 'Benutzer suchen';
            $view->heading = 'Benutzer suchen';
            $view->display();
    }

}