<?php 
require_once '../inc/connection.php';

if(! isset($_POST['submit'])){

    header("location:../register.php");
}
$name = trim(htmlspecialchars($_POST['name']));
$email = trim(htmlspecialchars($_POST['email']));
$password = trim(htmlspecialchars($_POST['password']));
$phone = trim(htmlspecialchars($_POST['phone']));

//validation
$errors = [];
//name(required , string , max=50)
    if(empty($name)){
        $errors[] = "name is required ";
    }elseif (is_numeric($name)){
        $errors[] = "name must be string ";

    }elseif(strlen($name) > 100){
        $errors[] = "name must be less than 100 char ";
    }

//email(required , email , )
if(empty($email)){
    $errors[] = "email is required ";
}elseif (! filter_var($email , FILTER_VALIDATE_EMAIL)){
    $errors[] = "email invalied  ";
}
//password(required  , min >=50)
if(empty($password)){
    $errors[] = "password is required ";
}elseif (strlen($password) < 6  ){
    $errors[] = "password must be more than 6 char  ";
}
//phone(inter  , 15)
if(empty($phone)){
    $errors[] = "phone is required ";
}elseif (! is_string($phone)){
    $errors[] = "phone not correct  ";

}elseif(strlen($phone) <11 ){
    $errors[] = "phone invalid  ";
}
$passwordHashed = password_hash($password , PASSWORD_DEFAULT);


if(empty($errors)){
    $query = "insert into users(`name` , `email` , `password` , `phone`) values ('$name', '$email','$passwordHashed','$phone')";
    $runQuery = mysqli_query($conn , $query);
        if($runQuery){
            $_SESSION['success']="your account created successfuly ";
            header("location:../login.php");
        }else {
            $_SESSION['errors'] = "error while insert";
            header("location:../register.php");
        }
}else{
    $_SESSION['errors'] = $errors;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['phone'] = $phone;
    header("location:../register.php");
}
