<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

include("./BlogOps.php"); 
include("../config/common/Header.php");
$blogsObject= new BlogOps;

switch ($method) {
    case 'GET':
        echo json_encode($blogsObject->getAllBlogs());
        break;
    case 'POST':
        echo json_encode($blogsObject->saveBlog($input));
        break;        
    case 'PUT':
        if((sizeof($request) >0) && ($request[0] != "")){
            echo json_encode($blogsObject->updateBlog($request[0],$input));
        }else{
           echo json_encode("Please Provide the correct blog id");
        }
        break;
    case 'DELETE':
        if((sizeof($request) >0) && ($request[0] != "")){
            echo json_encode($blogsObject->deleteBlog($request[0],$input));
        }else{
           echo json_encode("Please Provide the correct blog id");
        }
        break;
    default:
        echo json_encode("Request method not found");
        break;
}
?>