<?php 
require_once '../inc/connection.php';

if( isset($_SESSION['user_id']))
  {


if(isset($_POST['submit']) && isset($_GET['id']) ){

$id = (int) $_GET['id'];
$title = htmlspecialchars(trim($_POST['title']));
$body = htmlspecialchars(trim($_POST['body']));
$errors=[];

if(empty($title)){
    $errors[]= "title is required";
}elseif(is_numeric($title)){
    $errors = "title must be string ";
}


//body
if(empty($body)){
    $errors[]= "body is required";
}elseif(is_numeric($body)){
    $errors []= "body must be string ";
}

}

//check
$query = "select id , image from posts where id=$id";
$runQuery = mysqli_query($conn , $query);

if(mysqli_num_rows($runQuery) ==1  ){
    $post= mysqli_fetch_assoc($runQuery);
    $oldImage = $post['image'];


    //check image 

    if(! empty($_FILES['image']['name'])){
        //checked

        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $size = $image['size']/(1024*1024);
        $ext =strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
        $error = $image['error'];

        //validation

        $array_ext = ["png" , "jpg" , "jpeg" , "gif"];
        if($error != 0 ){
         $errors[] = "image is required";
        }elseif( ! in_array($ext , $array_ext)){
         $errors[] = "image not correct";
        }elseif($size > 1 ){
         $errors[] = "image large size ";
        }
        $newName = uniqid().".$ext";

    }else{
        $newName = $oldImage;
    }


    //update

    if(empty($errors)){
        $query = "update posts set `title` = '$title' , `body` = '$body' , `image` = '$newName' where id=$id";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery){
            if(! empty($_FILES['image']['name'])){
                unlink("../upload/$oldImage");
            move_uploaded_file($imageTmpName , "../upload/$newName");
            header("location:../index.php");

            }else{
                $_SESSION['success']="post update successful ";
                header("location:../viewPost.php?id=$id");
            }
        }else{
            $_SESSION['errors']=["errorst while add post"];
        header("location:../editPost.php?id=$id");
        }
    }else{
        $_SESSION['errors']=$errors;
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        header("location:../editPost.php?id=$id");
    }

}else{
    $_SESSION['errors'] = ["post not founded"];
    header("location:../index.php");
}
  }else{
      $_SESSION['errors'] = ["please choose corect operation "];
    header("location:../index.php"); 
  }


