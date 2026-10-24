<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `register` WHERE id='$delete_id'");
    $message[] = '1 user has been deleted';
    header("location:admin_users.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="style.css">
    <style>
       body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

.admin_users {
    max-width: 1000px;
    margin: 50px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.admin_box_container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.admin_box {
    flex: 1 1 calc(33.333% - 20px);
    background-color: #ffffff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
}

.admin_box:hover {
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

.admin_box p {
    margin: 10px 0;
    font-size: 16px;
}

.admin_box span {
    font-weight: bold;
    color: #495057; /* Darker text for contrast */
}

.delete-btn {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 15px;
    color: #fff;
    background-color: #dc3545; /* Bootstrap Danger Color */
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s, transform 0.3s;
}

.delete-btn:hover {
    background-color: #c82333;
    transform: scale(1.05); /* Slightly enlarges button on hover */
}

@media (max-width: 768px) {
    .admin_box {
        flex: 1 1 calc(50% - 20px);
    }
}

@media (max-width: 480px) {
    .admin_box {
        flex: 1 1 100%;
    }
}
    </style>
</head>
<body>

<?php
include 'admin_header.php';
?>

<section class="admin_users" >
    <div class="admin_box_container">
        <?php
        // Requête pour sélectionner uniquement les utilisateurs de type 'user'
        $select_users = mysqli_query($conn, "SELECT * FROM `register` WHERE user_type='user'");
        while ($fetch_users = mysqli_fetch_assoc($select_users)) {
            ?>
            <div class="admin_box">
                <p>Username: <span><?php echo htmlspecialchars($fetch_users['name']); ?></span></p>
                <p>Email: <span><?php echo htmlspecialchars($fetch_users['email']); ?></span></p>
                <p>Usertype: <span style="color: green;"><?php echo htmlspecialchars($fetch_users['user_type']); ?></span></p>
                <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="delete-btn">Delete</a>
            </div>
            <?php
        }
        ?>
    </div>
</section>

<script src="admin_js.js"></script>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>