<?php

class GalleryOps{
    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getALlImageList(){
        $statement = $this->$databaseConnection->prepare("SELECT `id`, `mime`, `data`, `clientName`, `clientCompnay` FROM `gallery`;");
        $statement->execute(); 
        $statement->bind_result($id,  $mime, $data, $clientName, $clientCompnay);
        $images=array();
        while($statement->fetch()){ 
            $image = array(); 
            $image['id'] = $id; 
            $image['mime']=$mime; 
            $image['data'] = base64_encode($data); 
            $image['clientName'] = $clientName;
            $image['clientCompnay'] = $clientCompnay; 
            array_push($images, $image);
        }
        if(sizeof($images) >0){
            $statement->close();
            return $images;
        }else{
            $statement->close();
            return "There is no list of images";
        }
    }

    public function addImage($bodyData){
        $sqlQuery="INSERT INTO `gallery`(`mime`, `data`, `clientName`, `clientCompnay`) VALUES (?,?,?,?)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("ssss", $bodyData["mine"],addslashes($bodyData["data"]),$bodyData["name"],$bodyData["company"]);
        
        // execute query
        if($statement->execute()){
            $statement->close();
            return "Image inserted Successfully";
        }
        $statement->close();
        return "Image not inserted successfully";
    }

    public function updateImageData(){
        return "Update Image";
    }

    public function deleteImage(){
        return "delete images";
    }

}
?>