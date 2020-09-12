<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

include("./GalleryOps.php"); 
include("../config/common/Header.php");
$gallery= new GalleryOps;

switch ($method) {
    case 'GET':
        echo json_encode($gallery->getALlImageList());
        break;
    case 'POST':
        echo json_encode($gallery->addImage($input));
        break;        
    case 'PUT':
        echo json_encode($gallery->updateImageData());
        break;
    case 'DELETE':
        echo json_encode($gallery->deleteImage());
        break;
    default:
        echo json_encode("Request method not found");
        break;
}
?>