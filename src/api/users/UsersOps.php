<?php

class UsersOps{
    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function userLogin($bodyData){
        $sqlQuery="SELECT `name`, `email` FROM `users` WHERE `email`=? AND `password`=?";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        if($statement){
            $statement->bind_param("ss", $bodyData["email"],$bodyData["password"]);
            $statement->execute();
            $statement->bind_result($name, $email);
        }
        // execute query
        if($statement->fetch()){
            $response=array(
                "name"=>$name,
                "email"=>$email,
                "authrization"=>md5($name)
            );
            $statement->close();
            return $response;
        }
        $statement->close();
        return "User is not authroised";
    }

    public function createUser($bodyData){
        return "Save User";
    }

    public function updateUser(){
        return "Update User";
    }

    public function getAllUser(){
        return "Get all users";
    }

    public function deleteUser(){
        return "Delete user";
    }
}
?>