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
            // decode the base64 comeing blob data
            $decodeData=base64_decode($data);
            // store into array as string
            $image['data'] =(string)"$decodeData"; 
            $image['clientName'] = $clientName;
            $image['clientCompany'] = $clientCompnay; 
            array_push($images, $image);
        }
        if(sizeof($images) >0){
            $statement->close();
            return $images;
        }else{
            $statement->close();
            return [];
        }
    }

    public function addImage($bodyData){
        $sqlQuery="INSERT INTO `gallery`(`mime`, `data`, `clientName`, `clientCompnay`) VALUES (?,?,?,?)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        // encode it into base64
        $decodedData = base64_encode($bodyData["data"]);
        $statement->bind_param("ssss", $bodyData["mine"],addslashes($decodedData),$bodyData["clientName"],$bodyData["clientCompany"]);
        
        // execute query
        if($statement->execute()){
            $row=mysqli_stmt_affected_rows($statement);
            $statement->close();
            return "$row Image inserted Successfully";
        }
        $statement->close();
        return "Image not inserted successfully";
    }

    public function updateImageData($id,$bodyData){
        $sqlQuery="UPDATE `gallery` SET `mime`=?,`clientName`=?,`clientCompnay`=? WHERE `id`=?";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("sssi", $bodyData["mime"],$bodyData["clientName"],$bodyData["clientCompany"],$id);
        $statement->execute();
        $row=mysqli_stmt_affected_rows($statement);
        // execute query
        if($row > 0){
            $statement->close();
            return "$id Id product details updated successfully";
        }
        $statement->close();
        return "$id Id product details not updated successfully";
    }

    public function deleteImage($id){
        $sqlQuery="DELETE FROM `gallery` WHERE `id`=?";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("i",$id);
        $statement->execute();
        $row=mysqli_stmt_affected_rows($statement);
        // execute query
        if($row >0){
            $statement->close();
            return "$id Id product details deleted successfully";
        }
        $statement->close();
        return "$id Id product details not deleted successfully";
    }
}
?>