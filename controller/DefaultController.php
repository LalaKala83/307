<?php
/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 04.12.2018
 * Time: 11:04
 */

class DefaultController
{
    public function index()
    {
        $view = new View('default_index');
        $view->title = 'Startseite';
        $view->heading = 'Startseite';
        $view->display();
    }

}