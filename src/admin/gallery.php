<?php
   include("../data/db/db.php");
  // If upload button is clicked ...
  if (isset($_POST['upload']) || isset($_POST['update']) || isset($_POST['delete']) ) {
	// Get Client Name
	$client_name=$_POST['person_name'];
	// Get Client Name
	$compnay_name=$_POST['compnay_name'];
	if(isset($_POST['upload'])){
		echo "insert";
		// Get image name
		$image_name = $_FILES['image']['name'];
    	// convert into blob 
		$image_bolob = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		// Query for executions  
		$sql = "INSERT INTO `gallery`( `mime`, `data`, `clientName`, `clientCompnay`) VALUES ('$image_name', '$image_bolob','$client_name','$compnay_name')";
	}else if(isset($_POST['update'])) {
		$id=$_POST['id'];
		echo "update".$id;
		$sql="UPDATE `gallery` SET `clientName`='$client_name',`clientCompnay`='$compnay_name' WHERE `id`=$id";
	}else if(isset($_POST['delete'])){
		$id=$_POST['id'];
		echo "delete".$id ;
		$sql="DELETE FROM `gallery` WHERE `id`=$id";
	}
	// execute query
	$result = mysqli_query($link, $sql);
	if($result){
		echo "Your Query Execute SuccessFully";
		header("Location: gallery.php");
	}else{
		echo "<script>alert('Your Query is Not Execute SuccessFully')</script>";
	 }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Gallery Image Upload</title>
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
            { "data": "clientName" },
			{ "data": "clientCompnay" },
            { "data": "image" },
			{ "data": "" }
		],
		"lengthMenu": [[2,5,10, 25, 50, -1], [2,5,10, 25, 50, "All"]],
		"pagingType": "full_numbers",
		"iDisplayLength": 2
	});
	$("#example").on('click','.button1',function(event){
		var row=$(this).closest('tr');
		var updateData = $('.display').dataTable().fnGetData(row);
		$('#id').val(updateData.id);
		$('#person_name').val(updateData.clientName);
		$('#compnay_name').val(updateData.clientCompnay);
		$('#button').attr('name','update')
		$('#button').val('Update Image Details');
		$('#button').css('background-color','green');
	})

	$("#example").on('click','.button2',function(event){
		var row=$(this).closest('tr');
		var deleteData = $('.display').dataTable().fnGetData(row);
		$('#id').val(deleteData.id);
		$('#person_name').val(deleteData.clientName);
		$('#compnay_name').val(deleteData.clientCompnay);
		$('#button').attr('name','delete')
		$('#button').val('Delete Image Details');
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
      <input type="text"  id="person_name" name="person_name"  placeholder="Enter Project Client Name" /><br>
	  <input type="text" id="compnay_name" name="compnay_name"  placeholder="Enter Compnay Name" /><br>
	  <input type="submit" id="button" name="upload" value="Submit Iamge Details">
  	</div>
</form>
<hr>
<table id="example" class="display" style="width:100%">
      <thead>
        <tr>
          <th>Sr. No</th>
		  <th>Client name</th>
		  <th>Compnay name</th>
          <th>Image</th>
          <th></th>  
		</tr>
      </thead>
	  <tbody>
		 <?php 
		 $result = mysqli_query($link, "SELECT * FROM `gallery`");
		 echo "<div class='row'>";	
		 while ($row = mysqli_fetch_array($result)) {
		 ?>
			<tr>
			  <td><?php echo $row['id']  ?></td>
			  <td><?php echo $row['clientName']  ?></td>
			  <td><?php echo $row['clientCompnay']  ?></td>
			  <td> <img src='data:image/jpeg;base64,<?php echo base64_encode($row['data']) ?>' alt='<?php echo $row['mime'] ?>'  class="img-thumbnail" width="307" height="240"/> </td>
			  <td><button class="button1" >Edit </button> <button class="button2" >Delete</button></td>
			</tr>
		 <?php }?>
	  </tbody>
</table>
</div>
</body>
</html>