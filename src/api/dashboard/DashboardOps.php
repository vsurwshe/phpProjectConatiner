<?php

class DashboardOps{

    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getCountOfDashboard(){
        return "Get All Count Dashboard";
    }
}

?>