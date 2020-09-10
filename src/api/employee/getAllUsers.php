<?php
include("./EmployeeOps.php"); 
include("../config/common/Header.php");
$employee= new EmployeeOps;
echo json_encode($employee->getAllUsers());
?>

