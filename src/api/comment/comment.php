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
        try {
            $operation=$_GET["operation"];
            $id=$_GET["id"];
            if($operation == 'DELETE' && !is_null($id)){
                if($id && !is_null($id)){
                    echo json_encode($comment->deleteComment());
                }else{
                    throw new Exception("Please Provide the correct id");
                }
            }else if((sizeof($request) >0) && ($request[0] != "")){
                echo json_encode($comment->getCommentById($request[0]));
            }else{
                echo json_encode($comment->getAllComments());
            }
        } catch (Exception $th) {
            echo json_encode("Error : ". $th->getMessage());
        }
        break;
    case 'POST':
        try {
            $id=$_GET["id"];
            if($id && !is_null($id)){
                echo json_encode($comment->updateComment());
            }else{
                echo json_encode($comment->saveComment($input));
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