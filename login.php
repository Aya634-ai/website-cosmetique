<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `register` WHERE email='$email' AND password='$password'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        }
    } else {
        $message[] = 'Incorrect email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Font awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            width: 850px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .image-container {
            flex: 1;
            background: rgb(206, 149, 78); /* Primary color */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image-container img {
            max-width: 100%;
            height: 450px;
            transform: scale(1);
            transition: transform 0.5s ease;
        }

        .image-container img:hover {
            transform: scale(1.1);
        }

        .form-container {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container h2 {
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

        .inputbox input {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        .inputbox input:hover {
            border-color: rgb(206, 149, 78); /* Primary color */
        }

        .inputbox input:focus {
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
        .inputbox input:valid ~ span {
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

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icons a {
            font-size: 20px;
            color: #555;
            background: #f4f4f4;
            padding: 10px;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background: rgb(206, 149, 78); /* Primary color */
            color: #fff;
            transform: scale(1.2);
        }

        .message {
            color: #fff;
            background-color: #d9534f; /* Professional red color */
            padding: 15px;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
            margin: 20px;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            z-index: 999;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for better visibility */
            font-size: 16px;
            transition: opacity 0.5s ease-out; /* Smooth fade-out */
        }

        .message i {
            cursor: pointer;
            font-size: 18px;
            margin-left: 10px;
        }

        .message.fade-out {
            opacity: 0;
        }
    </style>
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo "<div class='message'>
                <span>{$msg}</span>
                <i class='fa-solid fa-xmark' onclick='this.parentElement.remove();'></i>
              </div>";
    }
}
?>

<div class="container">
    <div class="image-container">
        <img src="pic.jpg" alt="Login Image">
    </div>
    <div class="form-container">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="inputbox">
                <input type="email" name="email" required>
                <span>Email</span>
            </div>
            <div class="inputbox">
                <input type="password" name="password" required>
                <span>Password</span>
            </div>
            <div class="links">
                <a href="#">Forgot Password</a>
                <a href="register.php">Sign up</a>
            </div>
            <input type="submit" value="Login" name="submit">
            <p style="text-align: center;">Or login with:</p>
            <div class="social-icons">
                <a href="#" class="google"><i class="fab fa-google"></i></a>
                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </form>
    </div>
</div>

<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
<script>
    document.querySelectorAll('.message i').forEach(function(closeIcon) {
        closeIcon.addEventListener('click', function() {
            const message = this.parentElement;
            message.classList.add('fade-out');
            setTimeout(() => {
                message.remove();
            }, 500);
        });
    });
</script>
</body>
</html>
