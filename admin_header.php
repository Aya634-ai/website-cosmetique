<?php
include 'config.php';

// Vérifiez si l'utilisateur est déjà connecté
if (isset($_SESSION['id'])) {
    header('location:login.php');
    exit(); // Assurez-vous d'appeler exit après header pour sortir du script
}

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        /* Googlefont Poppins CDN Link */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

.sidebar {
    position: fixed;
    height: 100%;
    width: 240px;
    background: rgb(249, 230, 143); /* Couleur de fond de la sidebar */
    transition: all 0.5s ease;
}

.sidebar.active {
    width: 60px;
}

.sidebar .logo-details {
    height: 80px;
    display: flex;
    align-items: center;
}

.sidebar .logo-details i {
    font-size: 28px;
    font-weight: 500;
    color: #fff;
    min-width: 60px;
    text-align: center;
}

.sidebar .logo-details .logo_name {
    color: #fff;
    font-size: 24px;
    font-weight: 500;
}

.sidebar .nav-links {
    margin-top: 10px;
}

.sidebar .nav-links li {
    position: relative;
    list-style: none;
    height: 50px;
}

.sidebar .nav-links li a {
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    text-decoration: none;
    color: black; /* Couleur du texte en noir */
    transition: all 0.4s ease;
}

.sidebar .nav-links li a.active {
    background:rgb(255, 217, 28); /* Couleur de fond pour l'élément actif */
    color: black; /* Texte actif en noir */
}

.sidebar .nav-links li a:hover {
    background:rgb(255, 192, 58); /* Couleur de fond lors du survol */
    color: black; /* Texte en noir lors du survol */
}

.sidebar .nav-links li i {
    min-width: 60px;
    text-align: center;
    font-size: 18px;
    color: #fff;
}

.sidebar .nav-links li a .links_name {
    color: #fff;
    font-size: 15px;
    font-weight: 400;
    white-space: nowrap;
}

.sidebar .nav-links .log_out {
    position: absolute;
    bottom: 0;
    width: 100%;
}

.home-section {
    position: relative;
    background: #f5f5f5; /* Couleur de fond de la section principale */
    min-height: 100vh;
    width: calc(100% - 240px);
    left: 240px;
    transition: all 0.5s ease;
}

.sidebar.active ~ .home-section {
    width: calc(100% - 60px);
    left: 60px;
}

.home-section nav {
    display: flex;
    justify-content: space-between;
    height: 80px;
    background: #fff; /* Couleur de fond de la barre de navigation */
    align-items: center;
    position: fixed;
    width: calc(100% - 240px);
    left: 240px;
    z-index: 100;
    padding: 0 20px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    transition: all 0.5s ease;
}

.sidebar.active ~ .home-section nav {
    left: 60px;
    width: calc(100% - 60px);
}

.home-section nav .sidebar-button {
    display: flex;
    align-items: center;
    font-size: 24px;
    font-weight: 500;
}

nav .sidebar-button i {
    font-size: 35px;
    margin-right: 10px;
}

.home-section nav .profile-details {
    display: flex;
    align-items: center;
    height: 50px;
    min-width: 190px;
    padding: 0 15px 0 2px;
}

nav .profile-details .admin_name {
    font-size: 15px;
    font-weight: 500;
    color: #333; /* Couleur du texte Admin */
    margin: 0 10px;
    white-space: nowrap;
}

nav .profile-details i {
    font-size: 25px;
    color: black; /* Couleur de l'icône de profil */
}
    </style>
</head>
<body>
    <div class="sidebar" style="bottom:0;left:0;">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus" style="color:black;"></i>
            <span class="logo_name" style="color:black;">GlOW & GO</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="admin_page.php" >
                    <i class="bx bx-grid-alt" style="color:black;"></i>
                    <span class="links_name" style="color:black;">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admin_users.php">
                    <i class="bx bx-user" style="color:black;"></i>
                    <span class="links_name" style="color:black;">Utilisateurs</span>
                </a>
            </li>
            <li>
                <a href="admin_orders.php">
                    <i class="bx bx-pie-chart-alt-2" style="color:black;"></i>
                    <span class="links_name" style="color:black;">Orders</span>
                </a>
            </li>
            <li>
                <a href="admin_products.php">
                    <i class="bx bx-pie-chart-alt-2" style="color:black;"></i>
                    <span class="links_name" style="color:black;">Product</span>
                </a>
            </li>
            <li>
                <a href="admin_messages.php">
                    <i class="bx bx-message" style="color:black;"></i>
                    <span class="links_name" style="color:black;">Messages</span>
                </a>
            </li>
           
            <li class="log_out">
                <a href="logout.php">
                    <i class="bx bx-log-out" style="color:black;"></i>
                    <span class="links_name" style="color:black;">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section" style="top: 100px;left: 300px;">
        <nav style="top:0;">
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="profile-details">
                <span class="admin_name">Admin</span>
                <i class="bx bx-chevron-down"></i>
            </div>
        </nav>