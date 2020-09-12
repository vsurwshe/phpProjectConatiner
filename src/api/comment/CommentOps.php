<?php

class CommentOps{
    private $databaseConnection; 

    function __construct(){
        include_once('../config/db/DataBaseConnect.php');
        $dataBaseObject = new DataBaseConnect; 
        $this->$databaseConnection = $dataBaseObject->connect(); 
    }

    public function getAllComments(){
        $statement = $this->$databaseConnection->prepare("SELECT `comment_id`, `comment_name`, `comment_body`, `comment_email` FROM `comments`;");
        $statement->execute(); 
        $statement->bind_result($comment_id, $comment_name, $comment_body, $comment_email);
        $comments=array();
        while($statement->fetch()){ 
            $comment = array(); 
            $comment['commentId'] = $comment_id; 
            $comment['commentName']=$comment_name; 
            $comment['commentMessage'] = $comment_body; 
            $comment['commentEmail'] = $comment_email;
            array_push($comments, $comment);
        }
        if(sizeof($comments) >0){
            $statement->close();
            return $comments;
        }else{
            $statement->close();
            return "There is no list of blogs";
        }
    }

    public function saveComment($bodyData){
        $sqlQuery="INSERT INTO `comments`(`comment_name`, `comment_body`, `comment_email`, `blog_id`) VALUES(?,?,?,?)";
        $statement = $this->$databaseConnection->prepare($sqlQuery);
        $statement->bind_param("ssss", $bodyData["name"],$bodyData["message"],$bodyData["email"],$bodyData["blogId"]);
        
        // execute query
        if($statement->execute()){
            $statement->close();
            return "Comment Created Successfully";
        }
        $statement->close();
        return "Comment not created successfully";
    }

    public function updateComment(){
        return "update Comment";
    }

    public function deleteComment(){
        return "Delete Comment";
    }
}
?>