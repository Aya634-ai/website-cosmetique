<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['id'])) {
    $message_id = $_GET['id'];
    $select_msg = mysqli_query($conn, "SELECT * FROM `message` WHERE id='$message_id'") or die('query failed');
    $fetch_msg = mysqli_fetch_assoc($select_msg);
} else {
    header('location:admin_messages.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Detail</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .message_detail {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .message_detail h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .message_detail p {
            margin: 15px 0;
            font-size: 16px;
        }

        .message_detail .delete-btn {
            display: inline-block;
            padding: 10px 15px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .message_detail .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="message_detail" style="margin-top:150px;">
    <h1 style="color:rgb(206, 149, 78); /* Background gradient */">Message Details</h1>

    <?php if ($fetch_msg): ?>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($fetch_msg['email']); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($fetch_msg['name']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($fetch_msg['number']); ?></p>
        <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($fetch_msg['message'])); ?></p>

        <a href="admin_messages.php?delete=<?php echo $fetch_msg['id']; ?>" 
           onclick="return confirm('Are you sure you want to delete this message?');" 
           class="delete-btn">Delete Message</a>
    <?php else: ?>
        <p class="empty">Message not found.</p>
    <?php endif; ?>
</section>

<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>
