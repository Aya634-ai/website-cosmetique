<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {
  $pro_name = $_POST['product_name'];
  $pro_price = $_POST['product_price'];
  $pro_quantity = $_POST['product_quantity'];
  $pro_image = $_POST['product_image'];

  $check = mysqli_query($conn, "SELECT * FROM `cart` where name='$pro_name' and user_id='$user_id'") or die('query failed');

  if (mysqli_num_rows($check) > 0) {
    $message[] = 'Already added to cart!';
  } else {
    mysqli_query($conn, "INSERT INTO `cart`(user_id,name,price,quantity,image) VALUES ('$user_id','$pro_name','$pro_price','$pro_quantity','$pro_image')") or die('query2 failed');
    $message[] = 'Product added to cart!';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="style.css">
  
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: none;
}
/* Style pour la vidéo */
.full-width-video {
  width: 100%;
  height: 500px; 
  display: block;
  margin: 0;
  padding: 0;
  object-fit: cover; 
}
 h1 {
  text-align: center;         
  font-size: 3em;            
  color: #8c6638;            
  font-family: 'Arial', sans-serif; 
  margin: 20px 0;           
}
/* Conteneur principal */
.home_cont {
  position: relative;
}
/*product*/
.products_cont{
  margin: 4rem;
}
.products_cont .pro_box_cont{
  margin: 2rem;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(30%, 1fr));
  gap: 3rem;
}
.pro_box{
  background-color: white;
  display: flex;
  flex-direction: column;
  padding: 1rem;
  justify-content: center;
  text-align: center;
  align-items: center;
  width: 80%;
  gap: 1rem;
  box-shadow: 5px 2px 20px 0 rgba(43,61,73,0.7);
  border-radius: 20px;
  position: relative;
}
.pro_box img{
  width: 60%;
  height: 70%;
}
.pro_box input{
  width: 60%;
}
.pro_box p{
  background-color: #C1121F;
  color: white;
  padding: 0.2rem 1rem;
  border-radius: 5px;
  position: absolute;
  top: 1rem;
  left: 1rem;
}
/* About Section */
.about_cont, .questions_cont {
  display: flex;
  gap: 2rem;
  width: 100%;
  margin: 2rem 0;
  padding: 2rem;
  background-color: #f9f5f1; 
}

.about_cont img {
  width: 40%;
  border-radius: 10px;
}

.about_descript, .questions {
  color: black; 
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
  color: #8c6638; 
}

.about_descript h4, .questions h4 {
  margin-bottom: 0; 
}

.about_descript p, .questions p {
  font-size: 1rem;
  color: #4a4a4a;
  margin-top: 0.5rem; 
  margin-bottom: 0; 
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
  background-color: #e5d8c3; 
  color: #4a4a4a; 
</style>
</head>

<body>

  <?php
  include 'user_header.php';
  ?>
<section class="home_cont">
  <div class="main_descrip">
    <!-- Ajout de la vidéo -->
    <video class="full-width-video" autoplay muted loop playsinline>
    <source src="video.mp4" type="video/mp4">
    Votre navigateur ne supporte pas la vidéo.
  </video>
  </div>
 <h1>Product</h1>
</section>
    <div class="pro_box_cont">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');

      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {

      ?>
          <form action="" method="post" class="pro_box">
            <img src="./uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
            <h3><?php echo $fetch_products['name']; ?></h3>
            <p>Rs. <?php echo $fetch_products['price']; ?>/-</p>
          
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'] ?>">
            <input type="number" name="product_quantity" min="1" value="1">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

            <input type="submit" value="Add to Cart" name="add_to_cart" class="product_btn">

          </form>

      <?php
        }
      } else {
        echo '<p class="empty">No Products Added Yet !</p>';
      }
      ?>
    </div>
  </section>
  <section class="about_cont">
    <img src="imag4.jpg" alt="">
    <div class="about_descript">
      <h2>About Us</h2>
      <p>
About Our Brand you deserve limitless beauty
Glow and Go is a range of cosmetic products focused on quality, effectiveness, and safety, designed to give your skin a natural glow. Our formulations are created in collaboration with industry experts, based on in-depth scientific research to ensure visible and long-lasting results.
    </p>
    <button class="product_btn" onclick="window.location.href='about.php';">Read More</button>
    </div>
  </section>

  <section class="questions_cont">
    <div class="questions">
    <h2>Have Any Queries?</h2>
    <p>At Bookiee, we value your satisfaction and strive to provide exceptional customer service. If you have any questions, concerns, or inquiries, our dedicated team is here to assist you every step of the way.</p>
    <button class="product_btn">Contact Us</button>
    </div>
    
  </section>
  <?php
  include 'footer.php';
  ?>
  <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

  <script src="script.js"></script>

</body>

</html>