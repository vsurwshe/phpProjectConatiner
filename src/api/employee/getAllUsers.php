<?php
include("./EmployeeOps.php"); 
$employee= new EmployeeOps;
echo json_encode($employee->getAllUsers());
?>

