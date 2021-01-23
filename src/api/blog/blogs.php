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
        try {
            $operation=$_GET["operation"];
            $id=$_GET["id"];
            if($operation == 'DELETE' && !is_null($id)){
                if($id && !is_null($id)){
                    echo json_encode($blogsObject->deleteBlog($id));
                }else{
                    throw new Exception("Please Provide the correct blog id");
                }
            }else if((sizeof($request) >0) && ($request[0] != "")){
                if($request[0]== "categoery"){
                    echo json_encode($blogsObject->getCategoerys());
                }else{
                    echo json_encode($blogsObject->getBlogById($request[0]));
                }
            }else{
                echo json_encode($blogsObject->getAllBlogs());
            }
        } catch (Exception $th) {
            echo json_encode("Error : ". $th->getMessage());
        }
        break;
    case 'POST':
        try {
            $id=$_GET["id"];
            if($id && !is_null($id)){
                echo json_encode($blogsObject->updateBlog($id,$input));
            }else{
                echo json_encode($blogsObject->saveBlog($input));
            }
        } catch (Exception $th) {
            echo json_encode("Error : ". $th->getMessage());
        }
        break;        
    case 'DELETE':
        try {
            $id=$_GET["id"];
            if($id && !is_null($id)){
                echo json_encode($blogsObject->deleteBlog($request[0],$input));
            }else{
                throw new Exception("Please Provide the correct blog id");
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