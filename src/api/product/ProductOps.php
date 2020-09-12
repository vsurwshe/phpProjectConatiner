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

    public function saveProduct($bodyData){
        $sqlQuery="INSERT INTO `product`(`mime`, `data`, `client_name`, `compnay_name`, `prodDisc`) VALUES (?,?,?,?,?)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("sssss", $bodyData["mine"],addslashes($bodyData["data"]),$bodyData["clientName"],$bodyData["companyName"],$bodyData["productDiscription"]);
        
        // execute query
        if($statement->execute()){
            $statement->close();
            return "Product details inserted Successfully";
        }
        $statement->close();
        return "Product details not inserted successfully";
    }

    public function updateProduct(){
        return "Update Product";
    }

    public function deleteProduct(){
        return "Delete Product";
    }
}
?>