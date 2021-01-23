<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

include("./ProductOps.php"); 
include("../config/common/Header.php");
$product= new ProductOps;

switch ($method) {
    case 'GET':
        try {
            $operation=$_GET["operation"];
            $id=$_GET["id"];
            if($operation == 'DELETE' && !is_null($id)){
                if($id && !is_null($id)){
                    echo json_encode($product->deleteProduct($id));
                }else{
                    throw new Exception("Please Provide the correct id");
                }
            }else{
                echo json_encode($product->getAllProducts());
            }
        } catch (Exception $th) {
            echo json_encode("Error : ". $th->getMessage());
        }
        break;
    case 'POST':
        try {
            $id=$_GET["id"];
            if($id && !is_null($id)){
                echo json_encode($product->updateProduct($id,$input));
            }else{
                echo json_encode($product->saveProduct($input));
            }
        } catch (Exception $th) {
            echo json_encode("Error : ". $th->getMessage());
        }
        break;        
    default:
        echo json_encode("Request method not found");
        break;
}

?>