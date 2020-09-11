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
        echo json_encode($product->getAllProducts());
        break;
    case 'POST':
        echo json_encode($product->saveProduct($input));
        break;        
    case 'PUT':
        // print_r($request);
        // print_r($input);
        echo json_encode($product->updateProduct());
        break;
    case 'DELETE':
        // print_r($request);
        // print_r($input);
        echo json_encode($product->deleteProduct());
        break;
    default:
        echo json_encode("Request method not found");
        break;
}

?>