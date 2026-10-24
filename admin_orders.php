<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');

    $message[] = 'Order Payment status has been updated';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id='$delete_id'");
    $message[] = '1 order has been deleted';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .admin_orders {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .option-btn, .delete-btn {
            padding: 5px 10px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .option-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
            margin-left: 5px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .empty {
            text-align: center;
            font-size: 18px;
            color: #f44336;
        }

    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="admin_orders" style="width: 6000px;left:100px">
    <h1 class="title">Placed Orders</h1>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Placed On</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Total Products</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');

            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fetch_orders['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['placed_on']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['name']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['number']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['email']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['address']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['total_products']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['method']); ?></td>
                        <td><?php echo htmlspecialchars($fetch_orders['payment_status']); ?></td>
                        <td>
                            <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                                <select name="update_payment">
                                    <option value="" selected disabled><?php echo htmlspecialchars($fetch_orders['payment_status']); ?></option>
                                    <option value="pending">pending</option>
                                    <option value="completed">completed</option>
                                </select>
                                <input type="submit" value="Update" name="update_order" class="option-btn">
                            </form>
                            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this order?');" 
                               class="delete-btn">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="11" class="empty">No orders placed yet!</td></tr>';
            }
            ?>
        </tbody>
    </table>
</section>

<script src="admin_js.js"></script>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

</body>
</html>
