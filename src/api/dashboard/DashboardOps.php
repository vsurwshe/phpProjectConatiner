<?php
include("../blog/BlogOps.php");
class DashboardOps{

    private $databaseConnection;

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getCountOfDashboard(){
        return "Get All Count Dashboard";
    }

    public function getBlogsCount(){
        $sqlQuery="SELECT MONTH(`created_at`) AS MONTH, COUNT(`created_at`) AS DATA FROM `blogs` GROUP BY MONTH(`created_at`)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->execute(); 
        $statement->bind_result($MONTH, $DATA);
        $blogsCount=array();
        while($statement->fetch()){ 
            $count=array(
                "month"=>$MONTH,
                "count"=>$DATA
            );
            array_push($blogsCount, $count);
        }
        if(sizeof($blogsCount) >0){
            $statement->close();
            return $blogsCount;
        }else{
            $statement->close();
            return [];
        }
    }

    public function getCommentByBlog(){
        $blogOps= new BlogOps();
        $listOfBlogs=$blogOps->getAllBlogs("Dashboard");
        $commentByBlogCount = array();
        $callBlogsWiseCommentApi=function($blog) use (&$commentByBlogCount){
            $data=$this->executeBlogWiseCommentCount($blog);
            if(count($data)>0){
                array_push($commentByBlogCount,array(
                    'blogId'=>$blog['blogId'],
                    'blogData'=>$data
                ));
            }
        };
        array_map($callBlogsWiseCommentApi,$listOfBlogs);
        if(sizeof($commentByBlogCount) >0){
            return $commentByBlogCount;
        }else{
            return [];
        }
    }

    public function executeBlogWiseCommentCount($blog){
        $sqlQuery="SELECT MONTH(`created_at`) AS MONTH, COUNT(`created_at`) AS DATA FROM `comments` WHERE `blog_id`=? GROUP BY MONTH(`created_at`)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("i",$blog['blogId']);
        $statement->execute(); 
        $statement->bind_result($MONTH, $DATA);
        $commentsData=array();
        while($statement->fetch()){ 
            array_push($commentsData, array(
                'month'=>$MONTH,
                'count'=> $DATA
            ));
        }
        $statement->close();
        return $commentsData;
    }
}
?>