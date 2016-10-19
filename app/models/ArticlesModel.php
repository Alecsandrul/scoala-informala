<?php
require_once "db.php";

class ArticlesModel extends DB {
    function getAll() {
        $sql = 'SELECT * FROM articles WHERE valid = 1';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
       
        return $sth->fetchAll(PDO::FETCH_ASSOC);   
    } 
    
    function addArticle($item) {
        $params = [':title' => $item["title"],
                    ':content' => $item["content"],
                    ':images' => $item["images"]];

        $sql = 'INSERT INTO articles(title, content, images, valid) VALUES(:title , :content, :images, 1)';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $this->dbh->lastInsertId();
        
    }
    
    function deleteArticle($id) {
        $params = [':id' => $id];

        $sql = 'DELETE from articles WHERE id=:id';
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        
        return $sth->rowCount();      
    }
}