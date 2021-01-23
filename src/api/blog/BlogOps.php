<?php
// ini_set( "display_errors", 0); 
class BlogOps{

    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    // this method will used for getting all blogs
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

    // this function will used for the get blogs by id
    public function getBlogById($id){
        $sqlQuery="SELECT `blog_name`, `blog_writer`, `blog_category`, `blog_path`,`created_at`, `updated_at` FROM `blogs` Where `blog_id`=?";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param('i', $id);
        $statement->execute(); 
        $result = $statement->get_result(); 
        $row = $result->fetch_assoc();
        if($row){
            $blog = array();
            $blog['blogId'] = $id; 
            $blog['blogName']=$row['blog_name']; 
            $blog['blogWriter'] = $row['blog_writer']; 
            $blog['blogCategory'] = $row['blog_category'];
            $blog['blogPath'] = $row['blog_path']; 
            $blog['createdAt'] = $row['created_at']; 
            $blog['updatedAt'] = $row['updated_at']; 
            $blog['blogBody']=$otherSubFunctionCall ==null ? file_get_contents($row['blog_path']) :"";
            return $blog;
        }else{
            throw new Exception("There is no record for id $id");
        }
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

    // this method will used for getting blog list by category
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
            throw new Exception("Sorry Your blog is not created");
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
        }else{
            $statement->close();
            throw new Exception("Blog not created successfully");
        }
    }

    // this method will used for updating blog
    public  function updateBlog($id,$bodyData){
        $currentBlogData=$this->getBlogById($id);
        if($currentBlogData && !is_null($currentBlogData)){
            $currentDirectory=dirname(__FILE__);
            $filterPath=explode("./", $currentBlogData['blogPath']);
            $filePath=$currentDirectory."/".$filterPath[1];
            $currentFileConent=file_get_contents($filePath);
            $sqlQuery="UPDATE `blogs` SET `blog_name`=?, `blog_writer`=?, `blog_category`=? WHERE blog_id=?";
            $statement = $this->$databaseConnection->prepare($sqlQuery);
            $statement->bind_param("sssi", $bodyData['blogName'],$bodyData['blogWriter'],$bodyData['blogCategory'],$id); 
            if(!$statement->execute()){
                throw new Exception("Statement not executed");
            }else{
                $updatedConent=file_put_contents($filePath, $bodyData["blogBody"], LOCK_EX);
                $row=mysqli_stmt_affected_rows($statement);
                if ($row >0) {
                    $statement->close();
                    return "$id blog updated with row Successfully";
                } else {
                    $statement->close();
                    return "$id updated without row successfully";
                }
            }
        }else{
            throw new Exception("Sorry for there is no record for the $id");
        }
    }

    // this function will used for delete blog record
    public function deleteBlog($id){
        $sqlQuery="DELETE FROM `blogs` WHERE `blog_id`=?";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("i",$id);
        // execute query
        $statement->execute();
        $row=mysqli_stmt_affected_rows($statement);
        if($row > 0){
            $statement->close();
            return "$id blog deleted Successfully";
        }else{
            $statement->close();
            throw new Exception("Blog not deleted successfully");
        }
    }
}
?>