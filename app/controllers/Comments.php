<?php

require "app/models/CommentsModel.php";

class Comments {
    
    function index() {
        $commentsModel = new CommentsModel();
        return $commentsModel->getArticleComments($_GET['id']);
    } 

    function addComment() {
       
        if (isset($_POST["article_id"])) {
            $commentsModel = new CommentsModel();
            $id = $commentsModel->addComment($_POST);
            return array("id" => $id);
        } 
    }

}