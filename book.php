<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>
   

<section class="header">

  <a href="home.php" class="logo">travel</a>

  <nav class="navbar">
   <a href="home.php">home</a>
   <a href="about.php">about</a>
   <a href="package.php">package</a>
   <a href="book.php">book</a>
  </nav>

  <div id="menu-btn" class="fas fa-bars"></div>

</section>


<div class="heading" style="background:url(1.jpg) no-repeat">
    <h1>book now</h1>
</div>

<!-- booking section starts-->

<section class="booking">

    <h1 class="heading-title">book your trip!</h1>
    <form action="book_form.php" method="post" class="book-form">

        <div class="flex">
            <div class="inputBox">
                <span>name :</span>
                <input type="text" placeholder="enter your name" name="name">
            </div>
            <div class="inputBox">
                <span>email :</span>
                <input type="email" placeholder="enter your email" name="email">
            </div>
            <div class="inputBox">
                <span>phone :</span>
                <input type="number" placeholder="enter your number" name="phone">
            </div>
            <div class="inputBox">
                <span>address :</span>
                <input type="text" placeholder="enter your address" name="address">
            </div>
            <div class="inputBox">
                <span>destination :</span>
                <input type="text" placeholder="place you want to visit" name="location">
            </div>
            <div class="inputBox">
                <span>no of guest :</span>
                <input type="text" placeholder="number of guest" name="guests">
            </div>
            <div class="inputBox">
                <span>date of arrival:</span>
                <input type="date" name="arrivals">
            </div>
            <div class="inputBox">
                <span>date of departure:</span>
                <input type="date" name="departure">
            </div>
        </div>

        <input type="submit" value="submit" class="btn" name="send">
    </form>
</section>


<!-- booking section ends-->

















<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
           <a href="home.php"> <i class="fa fa-angle-right"></i> home</a>
           <a href="about.php"> <i class="fa fa-angle-right"></i> about</a>
           <a href="package.php"> <i class="fa fa-angle-right"></i> package</a>
           <a href="book.php"> <i class="fa fa-angle-right"></i> book</a>

        </div>

        <div class="box">
            <h3>extra links</h3>
           <a href="#"> <i class="fa fa-angle-right"></i> ask questions</a>
           <a href="#"> <i class="fa fa-angle-right"></i> about us</a>
           <a href="#"> <i class="fa fa-angle-right"></i> privacy policy</a>
           <a href="#"> <i class="fa fa-angle-right"></i> terms of use</a>

        </div>

        <div class="box">
            <h3>contact info</h3>
           <a href="#"> <i class="fa fa-phone"></i> +91 9876543210</a>
           <a href="#"> <i class="fa fa-phone"></i> +91 9988776655</a>
           <a href="#"> <i class="fa fa-envelope"></i> singhkartik210@gmail.com</a>
           <a href="#"> <i class="fa fa-map"></i> varanasi, india-221010</a>

        </div>

        <div class="box">
            <h3>follow-us</h3>
            <a href="#"><i class="fab fa-facebook"></i>facebook</a>
            <a href="#"><i class="fab fa-twitter"></i>twitter</a>
            <a href="#"><i class="fab fa-instagram"></i>instagram</a>
            <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
        </div>

    </div>

    <div class="credit"> created by <span>AKA</span> | all rights reserved!</div>

</section>










<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="script.js"></script>



</body>
</html>