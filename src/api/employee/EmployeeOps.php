<?php

class EmployeeOps{

    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getAllUsers(){
        $stmt = $this->$databaseConnection->prepare("SELECT id, email, name, school FROM users;");
        $stmt->execute(); 
        $stmt->bind_result($id, $email, $name, $school);
        $users = array(); 
        while($stmt->fetch()){ 
            $user = array(); 
            $user['id'] = $id; 
            $user['email']=$email; 
            $user['name'] = $name; 
            $user['school'] = $school; 
            array_push($users, $user);
        }
        if(sizeof($users) >0){
            return $users;
        }else{
            return "There is no list of users";
        }
        $stmt->close();
    }

    public function saveEmployee(){
        return "Save Employee";
    }

    public function updateEmployee(){
        return "Update Empoyee";
    }

    public function deleteEmployee(){
        return "Delete Employee";
    }
}
?>