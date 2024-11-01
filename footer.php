<html>
    <header>
    <link rel="stylesheet" href="../style.css">

    </header>
<footer class="footer">
  <div class="footer-container">
    <div class="footer-section about">
      <h4>About Us</h4>
      <p>Welcome to our liquor shop. We offer a wide variety of the finest wines, spirits, and beers to suit your taste. Visit us for exclusive offers and events.</p>
    </div>

    <div class="footer-section contact">
      <h4>Contact Us</h4>
      <ul>
        <li><i class="fas fa-map-marker-alt"></i> 123 Liquor Street, City, Country</li>
        <li><i class="fas fa-phone-alt"></i> +1 (123) 456-7890</li>
        <li><i class="fas fa-envelope"></i> info@liquorshop.com</li>
      </ul>
    </div>

    <div class="footer-section social">
      <h4>Follow Us</h4>
      <ul class="social-links">
        <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
      </ul>
    </div>

    <div class="footer-section newsletter">
      <h4>Newsletter</h4>
      <p>Subscribe to our newsletter for the latest updates on new arrivals, exclusive offers, and events.</p>
      <form action="#">
        <input type="email" placeholder="Your Email" required>
        <br><br>
        <input type="submit" name="submit" value="Register" required>
      </form>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2024 Liquor Shop | All Rights Reserved</p>
    <p>Must be 21 years or older to purchase alcohol. Please drink responsibly.</p>
  </div>
</footer>

<style>

  

.footer {
  display: flex;
  background-color: #222;
  color: #ddd;
  padding: 20px 0;
  position: relative;
  bottom: 0;
  top:100%;
  width: 100%;

}



.footer-container {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-section {
  width: 22%;
  margin-bottom: 20px;
}

.footer-section h4 {
  font-size: 18px;
  color: #fff;
  margin-bottom: 15px;
}

.footer-section p {
  font-size: 14px;
  line-height: 1.6;
}

.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  font-size: 14px;
  margin-bottom: 10px;
}

.footer-section ul li i {
  margin-right: 10px;
}

.social-links a {
  color: #ddd;
  text-decoration: none;
  margin-right: 15px;
}

.social-links a i {
  font-size: 16px;
}

.footer-bottom {
  background-color: #111;
  color: #888;
  text-align: center;
  padding: 10px 0;
  font-size: 13px;
}

.newsletter input[type="email"] {
  padding: 10px;
  border: none;
  width: 70%;
  margin-right: 10px;
}



@media (max-width: 768px) {
  .footer-section {
    width: 45%;
  }
}

@media (max-width: 480px) {
  .footer-section {
    width: 100%;
  }
}

</style>
