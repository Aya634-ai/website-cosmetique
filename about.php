<?php
include 'config.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="style.css">
  
<style>
  /* About Section */
.about_cont, .questions_cont {
  display: flex;
  gap: 2rem;
  width: 100%;
  margin: 2rem 0;
  padding: 2rem;
  background-color: #f9f5f1; /* Crème clair */
}

.about_cont img {
  width: 40%;
  border-radius: 10px;
}

.about_descript, .questions {
  color: black; /* Gris foncé */
  display: flex;
  flex-direction: column;
  gap: 1rem;
  align-items: center;
  justify-content: center;
  letter-spacing: 1px;
  text-align: center;
}

.about_descript h2, .questions h2 {
  font-size: 1.5rem;
  font-weight: 900;
  color: #8c6638; /* Brun doré */
}

.about_descript h4, .questions h4 {
  margin-bottom: 0; /* Supprime l'espace en bas de l'h4 */
}

.about_descript p, .questions p {
  font-size: 1rem;
  color: #4a4a4a;
  margin-top: 0.5rem; /* Ajustez cette valeur si nécessaire */
  margin-bottom: 0; /* Supprime l'espace en bas du paragraphe */
}

.questions button, .about_descript button {
  width: 30%;
  padding: 0.8rem;
  font-size: 1.2rem;
  font-weight: 600;
  background-color: #8c6638; /* Brun doré */
  color: #f9f5f1;
  border: none;
  border-radius: 20px;
}

.questions button:hover, .about_descript button:hover {
  background-color: #e5d8c3; /* Gris foncé */
  color: #4a4a4a; /* Beige doux */
}
</style>
</head>
<body>
  
<?php
include 'user_header.php';
?>
<section class="about_cont">
    <img src="imag.jpg" alt="">
    <div class="about_descript">
    <h2>About Us</h2>
<h4>You deserve limitless beauty</h4>    
<p > Glow and Go developed a high-quality range of cosmetic products prioritizing effectiveness, safety, and natural radiance. Collaborated with industry experts and utilized in-depth scientific research to create formulations delivering visible, long-lasting results.</p>
<h4>Who are we ?</h4>
<P>
Glow and Go Embarked on a passion-driven journey to explore and share the transformative power of dermocosmetics. As the creator of Glow and go, this endeavor represents a deeply personal exploration beyond branding, rooted in innovation and dedication to skincare excellence.</P>

    <h4>Our Mission</H4>
    <P>To make premium skincare accessible by exceeding traditional standards, delivering results-driven products grounded in science.</P>
      <h4>Our Vision</h4>
<p>Glow and Go Advocates for authenticity by creating not just products, but a holistic experience and community where beauty and science coexist harmoniously.</p> 
    </div>
  </section>

  <section class="questions_cont">
    <div class="questions">
    <h2>Have Any Queries?</h2>
    <p>At Bookiee, we value your satisfaction and strive to provide exceptional customer service. If you have any questions, concerns, or inquiries, our dedicated team is here to assist you every step of the way.</p>
    <button class="product_btn" onclick="window.location.href='contact.php'">Contact Us</button>
    </div>
    
  </section>

<?php
include 'footer.php';
?>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

<script src="script.js"></script>

</body>
</html>