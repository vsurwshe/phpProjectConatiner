<?php

class BlogOps{

    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getAllBlogs($otherSubFunctionCall=null){
        $sqlQuery="SELECT `blog_id`, `blog_name`, `blog_writer`, `blog_category`, `blog_path`,`created_at`, `updated_at` FROM `blogs`";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->execute(); 
        $statement->bind_result($blog_id, $blog_name, $blog_writer, $blog_category, $blog_path, $created_at,$updated_at);
        $blogs=array();
        while($statement->fetch()){ 
            $blog = array(); 
            $blog['blogId'] = $blog_id; 
            $blog['blogName']=$blog_name; 
            $blog['blogWriter'] = $blog_writer; 
            $blog['blogCategory'] = $blog_category;
            $blog['blogPath'] = $blog_path; 
            $blog['createdAt'] = $created_at; 
            $blog['updatedAt'] = $updated_at; 
            $blog['blogBody']=$otherSubFunctionCall ==null ? file_get_contents($blog_path) :"";
            array_push($blogs, $blog);
        }
        if(sizeof($blogs) >0){
            $statement->close();
            return $blogs;
        }else{
            $statement->close();
            return [];
        }
    }

    public function getBlogById($id){
        return "Get Blog By Id";
    }

    // this method will used for the list of blogs category wise
    public function getCategoerys(){
        $sqlQuery="SELECT DISTINCT(`blog_category`) FROM `blogs`";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->execute(); 
        $statement->bind_result($blog_category);
        $categorys=array();
        while($statement->fetch()){
            array_push($categorys, $blog_category);
        }
        $statement->close();
        $blogList=array();
        foreach ($categorys as &$value) {
            $response=array(
                "category"=>$value,
                "blogsList"=>$this->getBlogsListByCategory($value)
            );
            array_push($blogList,$response);
        }
        return $blogList;
    }

    public function getBlogsListByCategory($category){
        $sqlQuery="SELECT `blog_id`, `blog_name`, `blog_writer`, `blog_category`, `blog_path` FROM blogs WHERE blog_category=?";
       if( $statement = $this->$databaseConnection->prepare($sqlQuery)){
        $statement->bind_param('s',$category);
        $statement->execute(); 
        $statement->bind_result($blog_id, $blog_name, $blog_writer, $blog_category, $blog_path);
        $blogs=array();
        while($statement->fetch()){ 
            $blog = array(); 
            $blog['blogId'] = $blog_id; 
            $blog['blogName']=$blog_name; 
            $blog['blogWriter'] = $blog_writer; 
            $blog['blogCategory'] = $blog_category;
            $blog['blogPath'] = $blog_path; 
            $blog['blogBody']=file_get_contents($blog_path);
            array_push($blogs, $blog);
        }
        $statement->close();
        return $blogs;
       }
       return [];
    }

    public function saveBlog($bodyData){
        $blogTitle=$bodyData["blogName"];
        $blogWriter=$bodyData["blogWriter"];
        $blogCategoreies=$bodyData["blogCategory"];
        $blogBody=$bodyData["blogBody"];
        if (!file_exists('./developerBlogs')) {
            mkdir('./developerBlogs', 0777, true);
        }
        $fileName= $this->getFilePath($blogTitle);
        // this will create file in the directory
        $file = fopen($fileName,"a+") or die(" Sorry File not created");
        // this will write the blog body in file 
        file_put_contents($fileName, $blogBody);
        
        if($file){
            $result=$this->saveBlogRecord($blogTitle,$blogWriter,$blogCategoreies,$fileName);
            $response = array(
                "FileUrl"=> $fileName,
                "message"=>$result
            );
            fclose($file);
            return $response;
        }else{
            return "Sorry Your blog is not created";
        }
    }

    // this function will help to create filename and dierctoy path
    public function getFilePath($title){   
        //Save File directoy path
        $directoy_path = "./developerBlogs/";
        // filename with path
        $fileNamePath = $directoy_path.$title.".html";
        // removeing the whitespace from above path
        $fileName=str_replace(" ","",$fileNamePath);
        return $fileName;
    }

    // this function will help to save blog in the database
    public function saveBlogRecord($blogTitle,$blogWriter,$blogCategoreies,$fileName){
        $sqlQuery="INSERT INTO `blogs`(`blog_name`, `blog_writer`, `blog_category`, `blog_path`) VALUES (?,?,?,?)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("ssss", $blogTitle,$blogWriter,$blogCategoreies,$fileName);
        // execute query
        $statement->execute();
        $row=mysqli_stmt_affected_rows($statement);
        if($row > 0){
            $statement->close();
            return "$row blog Created Successfully";
        }
        $statement->close();
        return "Blog not created successfully";
    }


    public  function updateBlog($id,$bodyData){
        $sqlQuery="UPDATE `blogs` SET `blog_name`=?, `blog_writer`=?, `blog_category`=? WHERE blog_id=?";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("sssi", $bodyData['blogName'],$bodyData['blogWriter'],$bodyData['blogCategory'],$id);
        // this will create file in the directory
        $file = fopen($bodyData['blogPath'],"w+") or die(" Sorry File not created");
        // this will write the blog body in file 
        file_put_contents($bodyData['blogPath'], $bodyData['blogBody']);
        // execute query
        $statement->execute();
        $row=mysqli_stmt_affected_rows($statement);
        if($row > 0 || $file){
            fclose($file);
            $statement->close();
            return "$id blog updated Successfully";
        }
        $statement->close();
        return "Blog not updated successfully";
    }

    public function deleteBlog($id){
        $sqlQuery="DELETE FROM `blogs` WHERE blog_id=?";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("i",$id);
        // execute query
        $statement->execute();
        $row=mysqli_stmt_affected_rows($statement);
        if($row > 0){
            $statement->close();
            return "$id blog deleted Successfully";
        }
        $statement->close();
        return "Blog not deleted successfully";
    }
}
?>