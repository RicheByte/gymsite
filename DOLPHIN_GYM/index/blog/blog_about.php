<?php
// Start the session to check if the user is logged in
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['logged_in'])) {
    header("Location: blog_login.php");
    exit;
}

// Include database connection and blog header
include 'include/db.php';
include_once 'component/blog_header.php';
?>

<!-- Custom CSS for About Page -->
<style>
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa; /* Light gray background */
  }
  .hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://via.placeholder.com/1500x600'); /* Add your hero image */
    background-size: cover;
    background-position: center;
    color: white;
    padding: 100px 0;
    text-align: center;
  }
  .hero-section h1 {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 20px;
  }
  .hero-section p {
    font-size: 1.2rem;
    max-width: 800px;
    margin: 0 auto;
  }
  .mission-section, .advantages-section, .testimonials-section, .faq-section {
    padding: 60px 0;
    background-color: white;
  }
  .mission-section h2, .advantages-section h2, .testimonials-section h2, .faq-section h2 {
    color: #007bff; /* Bootstrap primary color */
    font-weight: bold;
    margin-bottom: 20px;
  }
  .mission-section p, .advantages-section p, .testimonials-section p, .faq-section p {
    font-size: 1.1rem;
    color: #555;
  }
  .advantages-section {
    background-color: #f8f9fa; /* Light gray background */
  }
  .advantage-card {
    text-align: center;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
  .advantage-card i {
    font-size: 2.5rem;
    color: #007bff; /* Bootstrap primary color */
    margin-bottom: 15px;
  }
  .testimonials-section {
    background-color: white;
  }
  .testimonial-card {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
  .testimonial-card img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
  }
  .faq-section {
    background-color: #f8f9fa; /* Light gray background */
  }
  .faq-item {
    margin-bottom: 20px;
  }
  .faq-item h5 {
    color: #007bff; /* Bootstrap primary color */
    font-weight: bold;
  }
  .cta-section {
    background-color: #007bff; /* Bootstrap primary color */
    color: white;
    padding: 60px 0;
    text-align: center;
  }
  .cta-section h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 20px;
  }
  .cta-section p {
    font-size: 1.1rem;
    margin-bottom: 30px;
  }
  .cta-section .btn {
    background-color: white;
    color: #007bff;
    font-weight: bold;
    padding: 10px 30px;
    border-radius: 25px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  .cta-section .btn:hover {
    background-color: #0056b3; /* Darker shade on hover */
    color: white;
  }
</style>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <h1>About Us</h1>
    <p>Welcome to Fitness Blog, your ultimate destination for fitness tips, workout routines, and healthy living advice. We are passionate about helping you achieve your fitness goals and live a healthier, happier life.</p>
  </div>
</section>

<!-- Mission Section -->
<section class="mission-section">
  <div class="container">
    <h2 class="text-center">Our Mission</h2>
    <p class="text-center">At Fitness Blog, our mission is to inspire and empower individuals to lead healthier lives through fitness, nutrition, and wellness. We provide expert advice, practical tips, and motivational content to help you stay on track and achieve your goals.</p>
  </div>
</section>

<!-- Advantages Section -->
<section class="advantages-section">
  <div class="container">
    <h2 class="text-center">Why Choose Fitness Blog?</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="advantage-card">
          <i class="fas fa-dumbbell"></i>
          <h4>Expert Guidance</h4>
          <p>Get access to expert advice from certified fitness trainers and nutritionists.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="advantage-card">
          <i class="fas fa-heartbeat"></i>
          <h4>Personalized Plans</h4>
          <p>Customized workout and meal plans tailored to your fitness goals.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="advantage-card">
          <i class="fas fa-users"></i>
          <h4>Supportive Community</h4>
          <p>Join a community of like-minded individuals for motivation and support.</p>
        </div>
      </div>
    </div>
  </div>
</section>





<?php
// Include blog footer
include_once 'component/blog_footer.php';
?>