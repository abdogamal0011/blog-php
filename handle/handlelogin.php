<?php

require_once '../inc/connection.php';
if (isset($_POST['submit'])) {

    header("location:../login.php");
}
$email = trim(htmlspecialchars($_POST['email']));
$password = trim(htmlspecialchars($_POST['password']));

// validation

$errors = [];
//email(required , email , )
if (empty($email)) {
    $errors[] = "email is required ";
} elseif ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "email invalied  ";
}
//password(required  , min >=50)
if (empty($password)) {
    $errors[] = "password is required ";
} elseif (strlen($password) < 6) {
    $errors[] = "password must be more than 6 char  ";
}

//check

if(empty($errors)){
$query = "select id ,  email , password  from users where email ='$email'";
$runQuery = mysqli_query($conn, $query);
if (mysqli_num_rows($runQuery) == 1) {
    $user = mysqli_fetch_assoc($runQuery);
    $oldPassword = $user['password'];
    $isverify =  password_verify($password, $oldPassword);
    if ($isverify) {
        $_SESSION['user_id'] = $user['id'];
        header("location:../index.php");    
    } else {
        $_SESSION['errors'] = ["creidentials not correct "];
     $_SESSION['email'] = $email;
        header("location:../login.php");
    }
} else {
    $_SESSION['errors'] = ["this account not exist "];
    $_SESSION['email'] = $email;
    header("location:../login.php");
}
}else{
    $_SESSION['errors'] = $errors;
    $_SESSION['email'] = $email;
    header("location:../login.php");
}