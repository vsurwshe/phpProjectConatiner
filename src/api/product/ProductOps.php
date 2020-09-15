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
            // decode the base64 comeing blob data
            $decodeData=base64_decode($data);
            // store into array as string
            $product['data'] =(string)"$decodeData"; 
            $product['clientName'] = $clientName;
            $product['companyName'] = $companyName;
            $product['prodDisc'] = $prodDisc; 
            array_push($products, $product);
        }
        // print_r($products);
        if(sizeof($products) >0){
            return $products;
        }else{
            return "There is no list of products";
        }
        $statement->close();
    }

    public function saveProduct($bodyData){
        $sqlQuery="INSERT INTO `product`( `productName`, `data`, `clientName`, `companyName`, `prodDisc`) VALUES (?,?,?,?,?)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        // encode it into base64
        $decodedData = base64_encode($bodyData["data"]);
        $statement->bind_param("sssss", $bodyData["productName"],addslashes($decodedData),$bodyData["clientName"],$bodyData["companyName"],$bodyData["productDiscription"]);
        
        // execute query
        if($statement->execute()){
            $row=mysqli_stmt_affected_rows($statement);
            $statement->close();
            return "$row Product details inserted Successfully";
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