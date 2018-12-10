<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 10.12.2018
 * Time: 08:38
 */

class experienceController
{
    public function index()
    {
        // Anfrage an die URI /user/search weiterleiten (HTTP 302)
        header('Location: /entry/search');
        exit();
    }

    public function experience() {
        $view = new View('experience');
        $view->title = 'Entdecken';
        $view->heading = 'Entdecken';
        $view->display();
    }
}