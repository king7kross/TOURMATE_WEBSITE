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
   

<?php
session_start();
?>
<section class="header">

  <a href="home.php" class="logo">travel</a>

  <nav class="navbar">
   <a href="home.php">home</a>
   <a href="about.php">about</a>
   <a href="package.php">package</a>
   <a href="book.php">book</a>
   <?php if (isset($_SESSION['user'])): ?>
       <a href="#">Hello, <?=htmlspecialchars($_SESSION['user']['username'])?></a>
       <a href="logout.php">logout</a>
   <?php else: ?>
       <a href="login.php">login</a>
       <a href="register.php">register</a>
   <?php endif; ?>
  </nav>

  <div id="menu-btn" class="fas fa-bars"></div>

</section>


<div class="heading" style="background:url(1.jpg) no-repeat">
    <h1>packages</h1>
</div>

<!-- package section starts-->


<section class="packages">

    <h1 class="heading-title">top destinations</h1>

    <div class="box-container">
        <div class="box">
            <div class="image">
                <img src="a.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="b.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="c.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="d.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="e.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="f.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="g.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="h.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="i.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="j.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="k.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="l.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure and tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, sint.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div>
    </div>

  
</section>








<!-- package section endss-->


















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