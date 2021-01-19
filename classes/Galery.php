<?php 

class Galery {

    protected $galeryTitle;
    protected $arrayOfImages;
    protected $idOfGalery;


    function __construct($galeryTitle, $arrayOfImages, $idOfGalery){
        //implementacja konstruktora
        $this -> galeryTitle = $galeryTitle;
        $this -> arrayOfImages = $arrayOfImages;
        $this -> idOfGalery = $idOfGalery;
    }


        function addImagesToDatabase($databaseConnection){
            $preparedStatement = $databaseConnection->getMysqli() -> prepare("INSERT INTO images (title, image_URL,galery_id) VALUES (?,?,?)");
            for ($i = 0; $i < count($this -> arrayOfImages); $i++) {
                $preparedStatement -> bind_param("ssi", $this -> galeryTitle, $this -> arrayOfImages[$i], $this -> idOfGalery);
                $preparedStatement -> execute();
            }
        }
        

        static function selectGaleryID($databaseConnection) {
            $sql = "SELECT galery_id FROM images ORDER BY image_id DESC LIMIT 1";
            if ($result = $databaseConnection -> getMysqli() -> query($sql)) {
                return intval($result->fetch_object()->galery_id);
            }  else return -1;
        }

         static function selectImagesByGaleryID($databaseConnection, $galeryID) {
            $indexAndThumbnailArray = array();
            $sql = "SELECT image_URL FROM images WHERE galery_id = $galeryID ";
                if ($result = $databaseConnection -> getMysqli() -> query($sql)) {
                    while ($row = $result->fetch_object()){
                        array_push($indexAndThumbnailArray,$row);
                    }
                    return $indexAndThumbnailArray;
                }  else return -1;
            }

         static function selectImageForThumbnail($databaseConnection) {
            $indexAndThumbnailArray = array();
            $sql = "SELECT galery_id, title, image_URL as thumbnail FROM images GROUP BY galery_id";
            if ($result = $databaseConnection -> getMysqli() -> query($sql)) {
                while ($row = $result->fetch_object()){
                    array_push($indexAndThumbnailArray,$row);
                }
                return $indexAndThumbnailArray;
            }  else return -1;
         }



       
   /*      static function selectUniqueGaleryIDs($databaseConnection) {
             $sql = "SELECT DISTINCT galery_id FROM images";
             if ($result = $databaseConnection->getMysqli() -> query($sql)) {
              while ($temp = $result->fetch_object()) {
                    array_push($arrayOfIndexes,$temp);
              }
                return $arrayOfIndexes;
            }
            return -1;
        }*/ 
    }

 

    

?>