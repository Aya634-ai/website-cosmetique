<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

// Récupération des données
$total_pendings = 0;
$select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');

if (mysqli_num_rows($select_pending) > 0) {
    while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
        $total_price = $fetch_pendings['total_price'];
        $total_pendings += $total_price;
    }
}

// Total des paiements complétés
$total_completed = 0;
$select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');

if (mysqli_num_rows($select_completed) > 0) {
    while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
        $total_price = $fetch_completed['total_price'];
        $total_completed += $total_price;
    }
}

// Autres données
$number_of_orders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders`")) or die('query failed');
$number_of_products = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `products`")) or die('query failed');
$number_of_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `register` WHERE user_type='user'")) or die('query failed');
$number_of_admin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `register` WHERE user_type='admin'")) or die('query failed');
$number_of_accounts = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `register`")) or die('query failed');
$number_of_messages = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `message`")) or die('query failed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .box {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
            margin: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .box.green {
            background-color: #28a745;
        }

        .box.yellow {
            background-color: #ffc107;
        }

        .box.blue {
            background-color: #007bff;
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .chart {
            width: 45%;
        }

        canvas {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?php include 'admin_header.php'; ?>


<section class="container">
    <div class="box">
        <h3><?php echo $number_of_orders; ?></h3>
        <p>Commandes Passées</p>
    </div>

    <div class="box green">
        <h3><?php echo $number_of_products; ?></h3>
        <p>Produits Ajoutés</p>
    </div>

    <div class="box yellow">
        <h3><?php echo $number_of_messages; ?></h3>
        <p>Nouveaux Messages</p>
    </div>

    <div class="box blue">
        <h3><?php echo $number_of_accounts; ?></h3>
        <p>Total des Comptes</p>
    </div>
</section>

<div class="chart-container">
    <div class="chart">
        <canvas id="donutChart"></canvas>
    </div>
    <div class="chart">
        <canvas id="barChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctxDonut = document.getElementById('donutChart').getContext('2d');
const donutChart = new Chart(ctxDonut, {
    type: 'doughnut',
    data: {
        labels: ['Paiements en Attente', 'Paiements Complétés'],
        datasets: [{
            label: 'Statistiques',
            data: [<?php echo $total_pendings; ?>, <?php echo $total_completed; ?>],
            backgroundColor: ['#ff6384', '#36a2eb'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
        }
    }
});

const ctxBar = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Juil'],
        datasets: [{
            label: 'Commandes',
            data: [12, 19, 3, 5, 2, 3, 7], // Remplacez par vos données
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>