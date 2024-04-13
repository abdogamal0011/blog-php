<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }
        .nav .links a:hover , button:hover{
            background-color:#8000ff ;
        }
        body {
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            padding: 20px;
            background-color: #607d8b4a;
        }

        .nav {
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            padding: 10px;
            margin: 0;
        }

        .nav .links {
            width: 15%;
            display: flex;
            justify-content: space-around;
        }

        .nav .links a {
            color: white;
            padding: 4px 10px;
            background-color: #03a9f47a;
            text-decoration: none;
            border-radius: 4px;
            transition: all 1s;
        }

        .input {
            outline: none;
            border: none;
            width: 300px;
            height: 45px;
            border-radius: 10px;
            padding: 10px;
        }

        .form {
            width: 430px;
            height: 425px;
            display: flex;
            flex-direction: column;
            align-items: center;
            align-content: center;
            justify-content: space-between;
            background-color: rgba(255, 255, 255, 0.423);
            backdrop-filter: blur(30px);
            padding: 30px;
            -webkit-filter-blur: 10%;
            border-radius: 30px;
        }

        form button {
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            background-color: #03a9f47a;
            transition: all 1s;
        }

        form span a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .remember {
            width: 135px;
            height: 32px;
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: space-around;
            align-items: center;
        }
        .wrong{
            color: red;
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="links">
            <!-- <a href="Login.php">Log in</a> -->
            <!-- <a href="Register.php">Register</a> -->
        </div>
    </div>
    <div>
    <?php
?>
    <?php 
    session_start();
    require_once 'inc/error.php';
    ?>
        <form class="form" action="handle/handlRegister.php" method="post">
            
            <h3>Register Here</h3>
            <input placeholder="Enter Name" class="input" type="text" name="name" id=""value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; unset($_SESSION['name']) ?>">
            <input placeholder="Enter Email" class="input" type="text" name="email" id=""value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; unset($_SESSION['email']) ?>">
            <input class="input" placeholder="Enter Password" type="password" name="password" id="" value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password']; unset($_SESSION['password']) ?>">
            <input class="input" placeholder="Enter your phone " type="text" name="phone" id="" value="<?php if(isset($_SESSION['phone'])) echo $_SESSION['phone']; unset($_SESSION['phone']) ?>">
            <button type="submit" name="submit">Register</button>
           
            

        </form>
    </div>
</body>

</html>