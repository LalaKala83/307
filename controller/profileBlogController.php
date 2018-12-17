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

    /**
     * Es wird eine neue View erstellt, in welcher ein neuer Beitrag erstellt werden kann.
     */
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
        $view->username = $_SESSION["loggedInUser"];
        $view->validationMessage = $this->validation;
        $view->display($_SESSION["loggedInUser"]);
    }

    /**
     * Diese Funktion fügt die Eingaben für einen neuen Beitrag in die Datenbank ein.
     * Zuvor werden diese jedoch noch auf ihre Valididät geprüft.
     * @throws Exception
     */
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
        $blogRepository->setInBetweenTable($id, $_SESSION["loggedInUser"]);

        require_once ("profileController.php");
        header("Location: /profile/profile");
        }
        else {
            $this->createBlog();

        }
    }

    /**
     * Es wird überprüft, ob die Eingabefelder leer gelassen wurden und gibt
     * eine entsprechende Meldung zurück.
     * @param $title
     * @param $tag
     * @param $text
     * @return bool
     */
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