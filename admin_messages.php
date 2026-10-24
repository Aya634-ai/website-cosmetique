<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id='$delete_id'") or die('query failed');
    $message[] = '1 message has been deleted';
    header("location:admin_messages.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .admin_messages {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #e4e9f2;
        }

        .title {
            text-align: center;
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .email_list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .email_list li {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin: 12px 0;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e1e1e1;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .email_list li:hover {
            background-color: #f1f3f5;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .email_list li .email_info {
            font-size: 14px;
            color: #333;
        }

        .email_list li .email_subject {
            font-weight: bold;
            color: #007bff;
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
        }

        .email_list li .email_date {
            font-size: 12px;
            color: #aaa;
        }

        .email_icon {
            width: 24px; /* Adjust size as needed */
            height: 24px; /* Adjust size as needed */
            margin-right: 15px; /* Space between icon and text */
        }

        .empty {
            text-align: center;
            color: #777;
            font-size: 18px;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .admin_messages {
                padding: 15px;
            }

            .email_list li {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }

            .email_list li .email_subject {
                font-size: 14px;
            }

            .email_list li .email_date {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>

<section class="admin_messages" style="margin-top:150px;">
    <h1 class="title" style="text-align:center; margin-bottom: 20px;color: rgb(206, 149, 78);">Messages</h1>

    <ul class="email_list">
        <?php
        $select_msgs = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
        if (mysqli_num_rows($select_msgs) > 0) {
            while ($fetch_msgs = mysqli_fetch_assoc($select_msgs)) {
                ?>
                <li onclick="window.location.href='message_detail.php?id=<?php echo $fetch_msgs['id']; ?>'">
                    <img src="icon.png" alt="Email Icon" class="email_icon" style="width:60px;height:60px;"> <!-- Add your icon image here -->
                    <div class="email_info">
                        <span class="email_subject"><?php echo htmlspecialchars($fetch_msgs['email']); ?></span>
                        <span class="email_date"><?php echo date("Y-m-d", strtotime($fetch_msgs['created_at'])); ?></span>
                    </div>
                </li>
                <?php
            }
        } else {
            echo '<p class="empty">You Have No Messages!</p>';
        }
        ?>
    </ul>
</section>

<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>
<?php include 'admin_header.php'; ?>