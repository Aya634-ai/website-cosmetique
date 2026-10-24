<?php
include 'config.php';

if(isset($_POST['submit'])){

    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,md5($_POST['password']) );
    $cpassword=mysqli_real_escape_string($conn,md5($_POST['cpassword']) );
    $user_type=$_POST['user_type'];

    $select_users=mysqli_query($conn,"SELECT * FROM `register` WHERE email='$email' AND password='$password'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $message[]='User already exists!';
    }else{
        if($password!=$cpassword){
            $message[]='Confirm password not matched!';
        }
        else{
            mysqli_query($conn,"INSERT INTO `register`(name,email, password, user_type) VALUES('$name','$email','$cpassword','$user_type')") or die('query failed');
            $message[]='Registered Successfully!';
            header('location:login.php');
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>

    <!-- Font awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Link -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg,rgb(236, 215, 194),rgb(206, 149, 78)); /* Background gradient */
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 900px;
        }

        .image-container {
            flex: 1;
            background: rgb(206, 149, 78); /* Primary color */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
        max-width: 100%;
        height:550px;
            object-fit: cover;
        }
        

        .box {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .box h2 {
            font-size: 28px;
            margin-bottom: 30px;
            text-align: center;
            color: rgb(206, 149, 78); /* Primary color */
            font-weight: bold;
            text-transform: uppercase;
        }

        .inputbox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputbox input,
        .inputbox select {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        .inputbox input:hover,
        .inputbox select:hover {
            border-color: rgb(206, 149, 78); /* Primary color */
        }

        .inputbox input:focus,
        .inputbox select:focus {
            border-color: rgb(206, 149, 78);
            box-shadow: 0 0 8px rgba(206, 149, 78, 0.5);
        }

        .inputbox span {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            color: #aaa;
            pointer-events: none;
            transition: all 0.3s;
        }

        .inputbox input:focus ~ span,
        .inputbox input:valid ~ span,
        .inputbox select:focus ~ span {
            top: -5px;
            left: 15px;
            font-size: 12px;
            color: rgb(206, 149, 78); /* Primary color */
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(135deg, rgb(206, 149, 78), #f4f1ee); /* Primary color */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        input[type="submit"]:hover {
            background: rgba(206, 149, 78, 0.9);
            transform: scale(1.05);
        }

        .links {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin: 10px 0;
        }

        .links a {
            color: rgb(206, 149, 78); /* Primary color */
            text-decoration: none;
            transition: color 0.3s;
        }

        .links a:hover {
            color: #b37b4c; /* Slightly darker */
            text-decoration: underline;
        }

        .message {
            position: absolute;
            top: 10px;
            background: #ffefc1;
            padding: 15px 20px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .message i {
            cursor: pointer;
            color: #888;
            transition: color 0.3s;
        }

        .message i:hover {
            color: #444;
        }
    </style>
</head>

<body>

<?php
if(isset($message)){
    foreach($message as $msg){
        echo '
        <div class="message">
            <span>'.$msg.'</span>
            <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
        </div>
    ';    
    } 
}
?>

<div class="container">
    <div class="image-container">
        <img src="pic.jpg" alt="Register Image">
    </div>

    <div class="box">
        <form action="" method="post">
            <h2>Register</h2>

            <div class="inputbox">
                <input type="text" name="name" required="required">
                <span>Name</span>
            </div>

            <div class="inputbox">
                <input type="email" name="email" required="required">
                <span>Email</span>
            </div>

            <div class="inputbox">
                <input type="password" name="password" required="required">
                <span>Password</span>
            </div>

            <div class="inputbox">
                <input type="password" name="cpassword" required="required">
                <span>Confirm Password</span>
            </div>

            <div class="inputbox">
                <select name="user_type">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="links">
                <a href="#">Forgot Password</a>
                <a href="login.php">Login</a>
            </div>

            <input type="submit" value="Register Now" name="submit">
        </form>
    </div>
</div>

<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
</body>
</html>
