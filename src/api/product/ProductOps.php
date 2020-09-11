<?php

class ProductOps{
    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getAllProducts(){
        $statement = $this->$databaseConnection->prepare("SELECT id, mime, data, client_name, compnay_name, prodDisc FROM product;");
        $statement->execute(); 
        $statement->bind_result($id, $mime, $data, $client_name, $compnay_name, $prodDisc);
        $products = array();
        while($statement->fetch()){ 
            $product = array(); 
            $product['id'] = $id; 
            $product['mime']=$mime; 
            $product['data'] = base64_encode($data); 
            $product['client_name'] = $client_name;
            $product['compnay_name'] = $compnay_name;
            $product['prodDisc'] = $prodDisc; 
            array_push($products, $product);
        }
        if(sizeof($products) >0){
            return $products;
        }else{
            return "There is no list of products";
        }
        $statement->close();
    }
}
?>