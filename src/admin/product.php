<?php
   include("../data/db/db.php"); 
   // If upload ,update/delete button is clicked ...
if (isset($_POST['upload']) || isset($_POST['update']) || isset($_POST['delete']) ) {
	    // Get Client Name
	     $client_name=$_POST['person_name'];
	    // // Get Client Name
	     $compnay_name=$_POST['compnay_name'];
	    // // Get Product Discrptions
	     $prod_disc=$_POST['product_disp'];
	
	if(isset($_POST['upload'])){
		echo "insert";
		// Get image name
		$image_name = $_FILES['image']['name'];
		// convert into blob 
		$image_bolob = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		// Query for executions  
		$sql = "INSERT INTO `product`( `mime`, `data`, `client_name`, `compnay_name`,`prodDisc`) VALUES ('$image_name', '$image_bolob','$client_name','$compnay_name','$prod_disc')";
	}else if(isset($_POST['update'])) {
		$id=$_POST['id'];
		echo "update".$id;
		$sql="UPDATE `product` SET `client_name`='$client_name',`compnay_name`='$compnay_name',`prodDisc`='$prod_disc' WHERE `id`=$id";
	}else if(isset($_POST['delete'])){
		$id=$_POST['id'];
		echo "delete".$id ;
		$sql="DELETE FROM `product` WHERE `id`=$id";
	}
	// execute query
	$result = mysqli_query($link, $sql);
	if($result){
		echo "Your Execution SuccessFully Executed";
		header("Location: product.php");
	}else{
		echo "<script>alert('Your Execution is Not Executed SuccessFully')</script>";
	 }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Product Informations Upload</title>
<link rel="stylesheet" href="../css/admin.css">
<link rel="stylesheet" href="../css/jquery.dataTables.min.css">
<script src="../js/jquery-2.2.3.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
</head>
<script>
$(document).ready(function() {
    $('#example').DataTable(
		{"columns": [
			{ "data": "id" },
			{ "data": "client_name" },
			{ "data": "compnay_name" },
            { "data": "image_name" },
			{ "data": "image" },
			{ "data": "prodDisc" },
			{ "data": "" }
		],
		"lengthMenu": [[2,5,10, 25, 50, -1], [2,5,10, 25, 50, "All"]],
		"pagingType": "full_numbers",
		"iDisplayLength": 2
		});
	$(".button1").on('click',function(event){
		var row=$(this).closest('tr');
		var updateData = $('.display').dataTable().fnGetData(row);
		$('#id').val(updateData.id);
		$('#person_name').val(updateData.client_name);
		$('#compnay_name').val(updateData.compnay_name);
		$('#product_disp').val(updateData.prodDisc);
		$('#button').attr('name','update')
		$('#button').val('Update Product Details');
		$('#button').css('background-color','green');
	})

	$(".button2").on('click',function(event){
		var row=$(this).closest('tr');
		var deleteData = $('.display').dataTable().fnGetData(row);
		$('#id').val(deleteData.id);
		$('#person_name').val(deleteData.client_name);
		$('#compnay_name').val(deleteData.compnay_name);
		$('#product_disp').val(deleteData.prodDisc);
		$('#button').attr('name','delete')
		$('#button').val('Delete Product Details');
		$('#button').css('background-color','red');
	})
} );
</script>
<body>
<div id="content">	
<form method="POST" enctype="multipart/form-data">
  	<div>
	  <input type="hidden" id="id" name="id"/>
  	  <input type="file" name="image" ><br>
      <input type="text" id="person_name" name="person_name"  placeholder="Enter Project Client Name" /><br>
	  <input type="text" id="compnay_name" name="compnay_name"  placeholder="Enter Compnay Name" /><br>
	  <textArea id="product_disp" name="product_disp"  placeholder="Enter Product Discription" ></textArea>
	  <input type="submit" id="button" name="upload" value="Submit Product Details">
  	</div>
</form>
<hr>
<table id="example" class="display" style="width:100%">
      <thead>
        <tr>
          <th>id</th>
		  <th>Client Name</th>
		  <th>Compnay Name</th>
          <th>Image name</th>
          <th>Image</th>
		  <th>Discription</th>
		  <th></th> 
		</tr>
      </thead>
	  <tbody>
		 <?php 
		 $result = mysqli_query($link, "SELECT * FROM `product`");
		 echo "<div class='row'>";	
		 while ($row = mysqli_fetch_array($result)) {
		 ?>
			<tr>
			  <td><?php echo $row['id']  ?></td>
			  <td><?php echo $row['client_name']  ?></td>
			  <td><?php echo $row['compnay_name']  ?></td>
			  <td><?php echo $row['mime']  ?></td>
			  <td> <img src='data:image/jpeg;base64,<?php echo base64_encode($row['data']) ?>' alt='<?php echo $row['mime'] ?>'  class="img-thumbnail" width="307" height="240"/> </td>
			  <td><?php echo $row['prodDisc']  ?></td>
			  <td><button class="button1">Edit </button> <button class="button2">Delete</button></td>
			</tr>
		 <?php }?>
	  </tbody>
</table>
</div>
</body>
</html>