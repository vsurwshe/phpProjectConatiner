<?php 
include_once("../../data/db/db.php");
?>
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>V & Y | Admin Blogs </title>  
           <script src="../../js/jquery.min.js"></script>  
           <link rel="stylesheet" href="../../css/bootstrap.min.css" />  
           <script src="../../js/jquery.dataTables.min.js"></script>  
           <script src="../../js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="../../css/dataTables.bootstrap.min.css" />  
      </head>  
      <body>  
           <div class="container">  
                <h3 align="center">Admin Blogs Created</h3>  
                <br />
                <button id="createNewBlog" style="float: right;background-color: green;color: white;">Add New Blog </button> <br/><br/>  
                <div class="table-responsive">  
                     
                     <table id="blogs_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Blog Id</td>  
                                    <td>Blog Name</td>
                                    <td>Blog Writer</td>  
                                    <td>Blog Catgoery</td>
                                    <td>Blog Path</td>  
                                    <td></td>
                                    <td></td>  
                               </tr>  
                          </thead>  
                          <?php  
                          $selectBlogsQuery="SELECT * FROM `blogs`";
                          $blogsQueryResult= mysqli_query($link, $selectBlogsQuery) or die("query not executed");
                          while($row = mysqli_fetch_array($blogsQueryResult))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["blog_id"].'</td>  
                                    <td>'.$row["blog_name"].'</td>  
                                    <td>'.$row["blog_writer"].'</td>  
                                    <td>'.$row["categorise"].'</td>  
                                    <td>'.$row["blog_path"].'</td> 
                                    <td></td>
                                    <td></td> 
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#blogs_data').DataTable({
          "lengthMenu": [[3, 5, 10, 50, -1], [3, 5, 10, 50, "All"]],
            "pageLength": 3, // This is the no of default rows/entries shown in datatable
            "pagingType": "full_numbers", // This shows pagination list
          columnDefs: [
          // Define a button in the datatable
          {
            "targets": -2,
            "data": null,
            "createdCell":(td,cellData,rowData,row,col)=>{
                   $(td).click(e=>{ editFunctions(rowData);})
               },
            "defaultContent": "<button style='background-color: yellow;'>Edit</button>"
          },
          {
            "targets": -1,
            "data": null,
            "createdCell":(td,cellData,rowData,row,col)=>{
                   $(td).click(e=>{ deleteFunctions(rowData);})
               },
            "defaultContent": "<button style='background-color: red;'>Delete</button>"
          }
     ]
     });  
     $("#createNewBlog").click(function(){
          location.href="./writeBlog.php";
     })
     function editFunctions(RowData){
          location.href="./writeBlog.php?data="+RowData[0];
     }
     function deleteFunctions(RowData){
          console.log("Delete Row Data ",RowData);
          var userResult=confirm("Are sure want to delete this Blog ?")
          if(userResult=== true){
               console.log("Ok Delete")
               $.ajax({
                    type:"POST",
                    url:"./delete.php",
                    data:{
                         blogId:RowData[0],
                         blogFile:RowData[4]
                    },
                    success:function(data){
                      console.log("Success Data ", data);
                      if(data){
                           location.reload();
                      }
                    },
                    error:function(error){
                         console.log("You Got Error ",error);
                    }
               });
          }
          
     }
     
 });  
 </script>  