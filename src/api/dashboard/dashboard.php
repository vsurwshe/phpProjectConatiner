<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

include("./DashboardOps.php"); 
include("../config/common/Header.php");
$DashboardObject= new DashboardOps;

switch ($method) {
    case 'GET':
        echo json_encode("Called GET");
        break;
    case 'POST':
        if((sizeof($request) >0) && ($request[0] != "")){
            if($request[0]== "getBlogsCount"){
                echo json_encode($DashboardObject->getBlogsCount($input));
            }else if($request[0]== "getCommentCount"){
                echo json_encode($DashboardObject->getCommentByBlog($input));
            }else{
                echo json_encode($DashboardObject->getBlogById($request[0]));
            }
        }else{
            echo json_encode("Called Post");
        }
        break;        
    case 'PUT':
        echo json_encode("Called Put");
        break;
    case 'DELETE':
        echo json_encode("Called Delete");
        break;
    default:
        echo json_encode("Request method not found");
        break;
}
?>