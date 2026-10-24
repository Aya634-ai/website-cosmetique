<section class="footer">
  <style>
    .footer {
      background-color: #f9f5f1; /* Couleur douce et naturelle */
      color: #4a4a4a; /* Texte gris pour contraste */
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      padding: 20px 50px;
      border-top: 2px solid #e5d8c3; /* Ligne séparatrice subtile */
      font-family: 'Arial', sans-serif;
    }

    .footer_box_container {
      width: 100%;
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }

    .footer_box {
      flex: 1 1 250px;
      margin: 30px;
    }

    .footer_box img {
      max-width: 500px;
      height: 70px;
      margin-bottom: 15px;
    }

    .footer_box h3 {
      color: #8c6638; 
      margin-bottom: 10px;
      font-size: 1.2em;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .footer_box p,
    .footer_box a {
      color: #4a4a4a;
      font-size: 0.9em;
      line-height: 1.5em;
      text-decoration: none;
      display: block;
      margin-bottom: 5px;
    }
   

    .footer_box a:hover {
      color: #8c6638; 
    }

    .social-icons {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .social-icons i {
      color: #8c6638;
      font-size: 1.5em;
      margin-right: 10px;
      transition: color 0.3s;
    }

    .social-icons a:hover i {
      color: #8c6638;
    }


    /* Responsive Design */
    @media screen and (max-width: 768px) {
      .footer {
        flex-direction: column;
        text-align: center;
        padding: 20px;
      }

      .footer_box_container {
        flex-direction: column;
        align-items: center;
      }

      .footer_box {
        flex: 1 1 100%;
        text-align: center;
        margin: 10px 0;
      }

      .footer_box img {
        width: 50%;
        margin: 0 auto;
      }
    }
  </style>
  
  <div class="footer_box_container">
    <div class="footer_box">
      <div class="footer_logo_cont">
        <img src="image.jpg" alt="Logo">
      </div>
      <p>Reveal your natural beauty with our Cosmetic products inspired by nature. With us, authenticity meets Moroccan excellence for your ultimate well-being.</p>
    </div>
    
    <div class="footer_box">
      <h3>Contact us</h3>
      <p><i class="fas fa-phone"></i> +212 0633548790</p>
      <p><i class="fas fa-envelope"></i> glowandgo@gmail.com</p>
      <p><i class="fas fa-map-marker-alt"></i> Casablanca, Maroc</p>
      <p><i class="fa-solid fa-shop"></i> Shop Timings: 9am - 9pm</p>
    </div> 
    
    <div class="footer_box">
      <h3>Social Networks</h3>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
      </div>
      <div class="social-icons">
        <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
      </div>
      <div class="social-icons">
        <a href="#"><i class="fab fa-whatsapp"></i> +212661372987</a>
      </div>
    </div>
    
    <div class="footer_box">
      <h3>Quick Links</h3>
      <a href="home.php">Home</a>
      <a href="about.php">About</a>
      <a href="shop.php">Shop</a>
      <a href="contact.php">Contact</a>
    </div>
  </div>
</section>