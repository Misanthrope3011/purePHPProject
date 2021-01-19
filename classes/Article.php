<?php

class Article {

    protected $articleTitle;
    protected $articleHeader;
    protected $articleContent;
    protected $dateOfCreation;
    protected $author;
    protected $articleImage;
    static $numberOfArticlesOnPage = 3;
    //pozostale pola klasy:
    //...
    //metody klasy:
 
    function __construct($articleTitle, $articleHeader, $articleContent, $author, $articleImage){
    //implementacja konstruktora
    $this-> articleTitle = $articleTitle;
    $this -> articleHeader = $articleHeader;
    $this -> articleContent = $articleContent;
    $this -> dateOfCreation = new DateTime('NOW');
    $this -> articleImage = $articleImage;
    $this -> author = $author;
    //nadać wartości pozostałym polom – zgodnie z parametrami
    //...
    }

    static function getArticlesIds($databaseConnection){
        return $databaseConnection -> select("SELECT article_id FROM article");
    }

    static function checkIfArticleExists($databaseConnection, $passedArgument){
        $allIdsOfArticles = Article::getArticlesIds($databaseConnection);
        foreach($allIdsOfArticles as $articlesIds) {
            if ($articlesIds -> article_id == $passedArgument){
                return true;
            }
        }
        return false;
    }

    static function displayArticles($databaseConnection, $numberOfArticlesOnPage) {
        $arrayForArticle = $databaseConnection->select("SELECT * from article");
        $arrayForArticle = array_reverse($arrayForArticle);
        if (!(filter_input(INPUT_GET, "page"))) {
           $pageNumber = 1;
        } else {
             if ((ceil(count($arrayForArticle)/ $numberOfArticlesOnPage)) >= intval(filter_input(INPUT_GET, "page"))) {
                $pageNumber = intval(filter_input(INPUT_GET, "page"));
            } else {
                   header("Location:index.php");
                }
        } 
        $numberOfArticles = count($arrayForArticle);
        for ($i = (($pageNumber - 1) * $numberOfArticlesOnPage); $i < ($pageNumber * $numberOfArticlesOnPage) && ($i != $numberOfArticles); $i++) {
          if (isset($_SESSION['currentUser'])) {
            $currentUserData = unserialize($_SESSION['currentUser']);
            if($currentUserData -> status == USER::STATUS_USER) {
              echo ' <div class="post"> <h3>' .$arrayForArticle[$i] ->title. ' </h3>    <b> ' .$arrayForArticle[$i] -> header. '</b> <br/>  <div id="imageGrid">' .substr($arrayForArticle[$i] -> content, 0, 450). '  ';?>
              <img src = "data:image/jpg;charset=utf8;base64,<?php echo base64_encode($arrayForArticle[$i] -> image) ?> " />;  <?php
              echo '</div> </div> <a class = "fullView" href ="fullView.php?showFull=' . $arrayForArticle[$i] -> article_id.'">';
            } else {
              echo ' <div class="post"><h3>' .$arrayForArticle[$i] ->title. ' </h3>    <b> ' .$arrayForArticle[$i] -> header. '</b> <br/>  <div id="imageGrid">' .substr($arrayForArticle[$i] -> content, 0,  450). ' ';?>
              <img src = "data:image/jpg;charset=utf8;base64,<?php echo base64_encode($arrayForArticle[$i] -> image) ?> " />; 
              <?php echo '</div>   <button class="btn btn-danger"' . "onclick=delete_data({$arrayForArticle[$i]->article_id})". '> x </button> <a href = "create.php?editId=' .$arrayForArticle[$i] -> article_id .'"  <button class="edit">  E  </button> <a class = "fullView" href ="fullView.php?showFull=' . $arrayForArticle[$i] -> article_id.'">  View full </a> </div> <hr>';     
            }
         } else {
          echo ' <div class="post"><h3>' .$arrayForArticle[$i] ->title. ' </h3>    <b> ' .$arrayForArticle[$i] -> header. '</b> <br/> <div id="imageGrid"> ' .substr($arrayForArticle[$i] -> content, 0, 450). '  ';?>
          <img src = "data:image/jpg;charset=utf8;base64,<?php echo base64_encode($arrayForArticle[$i] -> image) ?> " />;  <?php
          echo '</div> </div>';
          }
      }

        return $numberOfArticles;
    }

    function addArticleToDatabase($databaseConnection) {

        $sql = "INSERT into `article`() VALUES (NULL, '{$this->articleTitle}', '{$this->articleHeader}', '{$this->articleContent}', '{$this->author}', '{$this->getDateOfCreation()}', '{$this -> articleImage}')"; 

        if ($result = $databaseConnection->getMysqli()->query($sql)) {
            echo 'Dodano';
          } else {
              echo $databaseConnection->getMysqli()->error;
          }
       }

       function updateArticle($databaseConnection, $articleId) {

        $sql = "UPDATE Article SET title = '{$this->articleTitle}', header = '{$this->articleHeader}', content = '{$this->articleContent}', image = '{$this->articleImage}' WHERE article_id = $articleId"; 

        if ($result = $databaseConnection->getMysqli()->query($sql)) {
            echo 'Dodano';
          } else {
              echo $databaseConnection->getMysqli()->error;
          }
       }
    
   
    //zdefiniować pozostałe metody

    /**
     * Get the value of userName
     */ 


    /**
     * Set the value of userName
     *
     * 
     */ 
 
    /*
     function getAllUsers($plik){
        $tab = json_decode(file_get_contents($plik));

        foreach ($tab as $val){
        $date = DateTime::createFromFormat("Y-m-d H:i:s.u", $val -> date -> date);    
        echo "<p>".$val->nickname." ".$val->nameAndSurname." ".$date->format("Y-m-d ")." </p>";
        }
       }

       */

    /**
     * Get the value of articleTitle
     */
    
     
    public function getArticleTitle()
    {
        return $this->articleTitle;
    }

    /**
     * Set the value of articleTitle
     *
     * @return  self
     */ 
    public function setArticleTitle($articleTitle)
    {
        $this->articleTitle = $articleTitle;

        return $this;
    }

    /**
     * Get the value of author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
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
     * Get the value of dateOfCreation
     */ 
    public function getDateOfCreation()
    {
        return $this -> dateOfCreation -> format('Y-m-d H:i:s');
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

    /**
     * Get the value of articleHeader
     */ 
    public function getArticleHeader()
    {
        return $this->articleHeader;
    }

    /**
     * Set the value of articleHeader
     *
     * @return  self
     */ 
    public function setArticleHeader($articleHeader)
    {
        $this->articleHeader = $articleHeader;

        return $this;
    }

    /**
     * Get the value of articleImage
     */ 
    public function getArticleImage()
    {
        return $this->articleImage;
    }

    /**
     * Set the value of articleImage
     *
     * @return  self
     */ 
    public function setArticleImage($articleImage)
    {
        $this->articleImage = $articleImage;

        return $this;
    }
}
?>