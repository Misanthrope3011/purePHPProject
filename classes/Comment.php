<?php

include_once("UserDatabase.php");

class Comment {

    private $userID;
    private $articleID;
    private $articleContent;
    private $dateOfCreation;

    function __construct($userID, $articleID, $articleContent){
        $this->userID = $userID;
        $this->articleID = $articleID;
        $this->articleContent = $articleContent;
        $this->dateOfCreation = new DateTime('NOW');
    }

    function addCommentToDatabase($databaseConnection) {
        $databaseConnection -> insert("INSERT into comments(articleID, userID, commentContent, dateOfCreation) VALUES ('{$this->articleID}', '{$this->userID}','{$this->articleContent}', '{$this->getDateOfCreation()}')"); 
    }

    static function getAllCommentsFromArticle($databaseConnection, $articleID) {
       return $databaseConnection -> select("SELECT comments.commentContent, comments.dateOfCreation, users.userName FROM comments INNER JOIN article ON comments.articleID = article.article_id INNER JOIN users ON comments.userID = users.id WHERE comments.articleID = $articleID");
    }
    /**
     * Get the value of articleContent
     */ 
    public function getArticleContent()
    {
        return $this->articleContent;
    }

    /**
     * Set the value of articleContent
     *
     * @return  self
     */ 
    public function setArticleContent($articleContent)
    {
        $this->articleContent = $articleContent;

        return $this;
    }

    /**
     * Get the value of articleID
     */ 
    public function getArticleID()
    {
        return $this->articleID;
    }

    /**
     * Set the value of articleID
     *
     * @return  self
     */ 
    public function setArticleID($articleID)
    {
        $this->articleID = $articleID;

        return $this;
    }

    /**
     * Get the value of userID
     */ 
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * Set the value of userID
     *
     * @return  self
     */ 
    public function setUserID($userID)
    {
        $this->userID = $userID;

        return $this;
    }

    /**
     * Get the value of dateOfCreation
     */ 
    public function getDateOfCreation()
    {
        return $this ->dateOfCreation ->format('Y-m-d H:i:s');
    }

    /**
     * Set the value of dateOfCreation
     *
     * @return  self
     */ 
    public function setDateOfCreation($dateOfCreation)
    {
        $this->dateOfCreation = $dateOfCreation;

        return $this;
    }
}


?>