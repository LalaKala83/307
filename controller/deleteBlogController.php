<?php
/**
 * Created by PhpStorm.
 * User: nyro
 * Date: 14.12.2018
 * Time: 18:34
 */

class deleteBlogController
{
    public function deleteBlog() {
        $blogId = $_GET['id'];

        require_once ("../repository/BlogRepository.php");
        $blogRepository = new BlogRepository();
        $blogRepository->deleteFromBetweenTable($blogId);
        $blogRepository->deleteFromTable($blogId);

        require_once ("profileController.php");
        header("Location: /profile/profile");
    }
}