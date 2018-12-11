<?php

/**
 * Created by PhpStorm.
 * User: balthr
 * Date: 04.12.2018
 * Time: 10:17
 */
class View{
    private $viewfile;

    private $properties = array();

    public function __construct($viewfile)
    {
        $this->viewfile = "../view/$viewfile.php";
    }

    public function __set($key, $value)
    {
        if (!isset($this->$key)) {
            $this->properties[$key] = $value;
        }
    }

    public function __get($key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }
    }


    public function display($isSignedIn)
    {
        if ($isSignedIn != null) {
            extract($this->properties);
            require '../view/header_signedUp.php';
            require $this->viewfile;
            require '../view/footer.php';
        } else {
            extract($this->properties);
            require '../view/header.php';
            require $this->viewfile;
            require '../view/footer.php';
        }

    }
}