<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

include("./UsersOps.php"); 
include("../config/common/Header.php");
$user= new UsersOps;

switch ($method) {
    case 'GET':
        try {
            $operation=$_GET["operation"];
            $id=$_GET["id"];
            if($operation == 'DELETE' && !is_null($id)){
                if($id && !is_null($id)){
                    echo json_encode($user->deleteComment());
                }else{
                    throw new Exception("Please Provide the correct id");
                }
            }else{
                echo json_encode($user->getAllComments());
            }
        } catch (Exception $th) {
            echo json_encode("Error : ". $th->getMessage());
        }
        break;
    case 'POST':
        try {
            $id=$_GET["id"];
            if($id && !is_null($id)){
                echo json_encode($user->updateComment());
            }else{
                echo json_encode($user->userLogin($input));
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