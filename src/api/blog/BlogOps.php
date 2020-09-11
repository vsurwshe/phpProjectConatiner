<?php

class BlogOps{

    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getAllBlogs(){
        $statement = $this->$databaseConnection->prepare("SELECT `blog_id`, `blog_name`, `blog_writer`, `categorise`, `blog_path` FROM `blogs`;");
        $statement->execute(); 
        $statement->bind_result($blog_id, $blog_name, $blog_writer, $categorise, $blog_path);
        $blogs=array();
        while($statement->fetch()){ 
            $blog = array(); 
            $blog['blogId'] = $blog_id; 
            $blog['blogName']=$blog_name; 
            $blog['blogWriter'] = $blog_writer; 
            $blog['categorise'] = $categorise;
            $blog['blogPath'] = $blog_path; 
            array_push($blogs, $blog);
        }
        if(sizeof($blogs) >0){
            $statement->close();
            return $blogs;
        }else{
            $statement->close();
            return "There is no list of blogs";
        }
    }

    public function saveBlog($bodyData){
        $blogTitle=$bodyData["blogTitle"];
        $blogWriter=$bodyData["blogWriter"];
        $blogCategoreies=$bodyData["blogCategoreies"];
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
        $sqlQuery="INSERT INTO `blogs`(`blog_name`, `blog_writer`, `categorise`, `blog_path`) VALUES (?,?,?,?)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("ssss", $blogTitle,$blogWriter,$blogCategoreies,$fileName);
        
        // execute query
        if($statement->execute()){
            $statement->close();
            return "Blog Created Successfully";
        }
        $statement->close();
        return "Blog not created successfully";
    }


    public  function updateBlog(){
        return "Update Blogs";
    }

    public function deleteBlog(){
        return "Delete Blogs";
    }
}
?>