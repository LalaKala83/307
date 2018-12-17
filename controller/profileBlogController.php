<?php
/**
 * Created by PhpStorm.
 * User: bnyfer
 * Date: 11.12.2018
 * Time: 10:53
 */

class profileBlogController
{
    private $validation = null;

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
        $view->validationMessage = $this->validation;
        $view->display($_SESSION["isSignedIn"]);
    }

    public function createTheBlog()
    {
        $title = $_POST["title"];
        $tag = $_POST["tags"];
        $image = $_POST["fileToUpload"];
        $text = $_POST["blog"];

        if($this->areInputsValid($title, $tag, $text)){
        require_once ("../repository/BlogRepository.php");
        $blogRepository = new BlogRepository();
        $id = $blogRepository->create($title, $tag, $image, $text);
        $blogRepository->setInBetweenTable($id, $_SESSION["isSignedIn"]);

        require_once ("profileController.php");
        header("Location: /profile/profile");
        }
        else {
            $this->createBlog();

        }
    }

    private function areInputsValid($title, $tag, $text){
        if (empty($title)) {
            $this->validation = "Die Eingabefelder dürfen nicht leer sein.";
            return false;
        }
        else{
            if (!is_string($title) or !is_string($tag) or !is_string($text)){
                $this->validation = "Die Eingabefelder dürfen nicht leer sein.";
                return false;
            }
            else {

                return true;
            }
        }

    }
}