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
        if((sizeof($request) >0) && ($request[0] != "")){
            echo json_encode($comment->getCommentById($request[0]));
        }else{
            echo json_encode($comment->getAllComments());
        }
        break;
    case 'POST':
        echo json_encode($comment->saveComment($input));
        break;        
    case 'PUT':
        echo json_encode($comment->updateComment());
        break;
    case 'DELETE':
        echo json_encode($comment->deleteComment());
        break;
    default:
        echo json_encode("Request method not found");
        break;
}
?>