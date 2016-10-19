<?php
require_once "db.php";

class CommentsModel extends DB {
    
    function getArticleComments($id) {
        $sql = 'SELECT * FROM comments WHERE article_id = ' . $id;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
       
        return $sth->fetchAll(PDO::FETCH_ASSOC);   
    } 
    
    function addComment($item) {
        $params = [':article_id' => $item["article_id"],
                    ':user_name' => $item["user_name"],
                    ':content' => $item["content"]];

        $sql = 'INSERT INTO comments(article_id, user_name, content) 
                VALUES(:article_id , :user_name, :content)';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
    
        return $this->dbh->lastInsertId();
    }
    
}