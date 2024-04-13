<?php 
require_once '../inc/connection.php';

if(isset($_SESSION['user_id'])){


//catch id , query check,  query delete 

if(isset($_POST['submit']) && isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $query = "select id , image from posts where id =$id ";
    $runQuery = mysqli_query($conn , $query);
    if(mysqli_num_rows($runQuery) ==1){
        $post = mysqli_fetch_assoc($runQuery);

        if(! empty($post)){
            $image = $post['image'];
            unlink("../upload/".$image);
        }
        $query = "delete from posts where id=$id";
        $runQuery =mysqli_query($conn , $query);
        if($runQuery){
            $_SESSION['success'] = "post deleted successfuly";
        header("location:../index.php");

        }else{
            $_SESSION['errors'] = ["error while deleted"];
    header("location:../index.php");
        }
    }else{
        $_SESSION['errors']=["post not founded "];
        header("location:../index.php");
    }

}else{
    $_SESSION['errors'] = ["please choose corect operation "];
    header("location:../index.php");
}
}
else{
      header("location:../login.php"); 
}




