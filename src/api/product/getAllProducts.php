<?php
include("./ProductOps.php"); 
include("../config/common/Header.php");
$product= new ProductOps;
echo json_encode($product->getAllProducts());
?>