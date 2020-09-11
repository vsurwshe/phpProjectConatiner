<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

include("./CommentOps.php"); 
include("../config/common/Header.php");
$comment= new CommentOps;

switch ($method) {
    case 'GET':
        echo json_encode($comment->getAllComments());
        break;
    case 'POST':
        echo json_encode($comment->saveComment($input));
        break;        
    case 'PUT':
        // print_r($request);
        // print_r($input);
        echo json_encode($comment->updateComment());
        break;
    case 'DELETE':
        // print_r($request);
        // print_r($input);
        echo json_encode($comment->deleteComment());
        break;
    default:
        echo json_encode("Request method not found");
        break;
}



?>