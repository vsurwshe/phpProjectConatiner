<?php
class DataBaseConnect{
    private $connection; 

    function connect(){

        include_once ('DataBaseConstant.php');

        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

        if(mysqli_connect_errno()){
            echo "Failed  to connect " . mysqli_connect_error(); 
            return null; 
        }
        
        // this will connect the database connections
        return $this->connection; 
    }

}

?>