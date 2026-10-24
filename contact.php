<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if (mysqli_num_rows($select_message) > 0) {
        $message[] = 'Message already sent!';
    } else {
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'Message sent successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="home.css">
    <style>
        .contact-info {
            display: flex;
            justify-content: space-around; /* Espace uniforme entre les éléments */
            padding: 2rem;
            background-color: #f8f9fa; /* Fond de section */
            border-radius: 8px; /* Coins arrondis */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Ombre */
        }
        .contact-item {
            text-align: center; /* Centrer le texte */
            color: #333; /* Couleur du texte */
            transition: transform 0.3s; /* Animation pour l'effet hover */
        }
        .contact-item:hover {
            transform: translateY(-5px); /* Effet de levée au survol */
        }
        .contact-item i {
            font-size: 3rem; /* Taille des icônes */
            color: #28a745; /* Couleur des icônes */
            margin-bottom: 10px; /* Espacement entre l'icône et le texte */
        }
        .contact-item span {
            display: block; /* Afficher le texte sur une nouvelle ligne */
            font-weight: bold; /* Texte en gras */
        }
    </style>
</head>
<body>

<?php include 'user_header.php'; ?>

<section class="contact-section" style="display: flex; justify-content: space-between; padding: 2rem;">
    <div class="contact-left" style="flex: 1; padding: 20px;">
        <h2>Contactez-nous</h2>
        <form action="" method="post" style="display: flex; flex-direction: column;">
            <input type="text" name="name" required placeholder="Entrez votre nom" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <input type="email" name="email" required placeholder="Entrez votre email" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <input type="text" name="number" required placeholder="Entrez votre numéro" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <textarea name="message" placeholder="Entrez votre message" rows="4" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
            <input type="submit" value="Envoyer le message" name="send" class="product_btn" style="padding: 10px; background-color:rgb(206, 149, 78); color: white; border: none; border-radius: 5px; cursor: pointer;">
        </form>
    </div>
    <div class="contact-right" style="flex: 1; height: 400px; border-left: 1px solid #ccc; padding-left: 20px;">
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3154.3332000255164!2d-7.589843684681078!3d33.573110380760536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1af9c6f7f2d3ef%3A0x2a6c20e9d8c0bcd7!2sCasablanca%2C%20Morocco!5e0!3m2!1sen!2sfr!4v1615540816327!5m2!1sen!2sfr"
    width="600"
    height="450"
    style="border:0;"
    allowfullscreen=""
    loading="lazy">
</iframe>
    </div>
</section>
<section class="contact-info" style="display: flex; justify-content: space-around; padding: 2rem;">
    <div class="contact-item" style="background-color: white; border-radius: 8px; padding: 20px; transition: transform 0.3s; text-align: center;">
        <i class="fas fa-phone" style="font-size: 3rem; color:rgb(206, 149, 78); margin-bottom: 10px;"></i>
        <span>Call Us</span>
        <small>+212 063354879</small>
    </div>
    <div class="contact-item" style="background-color: white; border-radius: 8px; padding: 20px; transition: transform 0.3s; text-align: center;">
        <i class="fas fa-envelope" style="font-size: 3rem; color:rgb(206, 149, 78); margin-bottom: 10px;"></i>
        <span>Email Address</span>
        <small>glowandgo@gmail.com</small>
    </div>
    <div class="contact-item" style="background-color: white; border-radius: 8px; padding: 20px; transition: transform 0.3s; text-align: center;">
        <i class="fas fa-map-marker-alt" style="font-size: 3rem; color:rgb(206, 149, 78); margin-bottom: 10px;"></i>
        <span>Address</span>
        <small>Casablanca, Maroc</small>
    </div>
</section>
<?php include 'footer.php'; ?>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
<script src="script.js"></script>

</body>
</html>