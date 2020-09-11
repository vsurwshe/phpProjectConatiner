<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

include("./EmployeeOps.php"); 
include("../config/common/Header.php");
$employee= new EmployeeOps;

switch ($method) {
    case 'GET':
        echo json_encode($employee->getAllUsers());
        break;
    case 'POST':
        echo json_encode($employee->saveEmployee($input));
        break;        
    case 'PUT':
        // print_r($request);
        // print_r($input);
        echo json_encode($employee->updateEmployee());
        break;
    case 'DELETE':
        // print_r($request);
        // print_r($input);
        echo json_encode($employee->deleteEmployee());
        break;
    default:
        echo json_encode("Request method not found");
        break;
}
?>

