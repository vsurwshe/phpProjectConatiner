<?php

class ProductOps{
    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getAllProducts(){
        $statement = $this->$databaseConnection->prepare("SELECT id, productName, mime, data, clientName, companyName, prodDisc FROM product;");
        $statement->execute(); 
        $statement->bind_result($id, $productName, $mime, $data, $clientName, $companyName, $prodDisc);
        $products = array();
        while($statement->fetch()){ 
            $product = array(); 
            $product['id'] = $id;
            $product['productName'] = $productName;
            $product['mime']=$mime; 
            $product['data'] = base64_encode($data); 
            $product['clientName'] = $clientName;
            $product['companyName'] = $companyName;
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
        $sqlQuery="INSERT INTO `product`(`productName`,`mime`, `data`, `clientName`, `companyName`, `prodDisc`) VALUES (?,?,?,?,?,?)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("ssssss", $bodyData["productName"],$bodyData["mine"],addslashes($bodyData["data"]),$bodyData["clientName"],$bodyData["companyName"],$bodyData["productDiscription"]);
        
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