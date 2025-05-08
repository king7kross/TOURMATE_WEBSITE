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
   
<!-- header section starts-->
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
<!-- header section ends-->



<section class="home">

<div class="swiper home-slider">
  <div class="swiper-wrapper">
      
    <div class="swiper-slide slide" style="background:url(1.jpg) no-repeat">
            
             <div class="content">
                <span>explore,discover,travel</span>
                <h3>travel around the world</h3>
                <a href="package.php" class="btn">discover more</a>
             </div>
    </div>
    
    <div class="swiper-slide slide" style="background:url(2.jpg) no-repeat">
            
             <div class="content">
                <span>explore,discover,travel</span>
                <h3>discover the new places</h3>
                <a href="package.php" class="btn">discover more</a>
             </div>
    </div>

    <div class="swiper-slide slide" style="background:url(3.jpg) no-repeat">
            
             <div class="content">
                <span>explore,discover,travel</span>
                <h3>make your tour worthwhile</h3>
                <a href="package.php" class="btn">discover more</a>
             </div>
    </div>

  </div>
   
      <div class="swiper-button-next"></div>
    <div class=" "></div>

</div>

</section>









<!-- sevices section starts-->

<section class="services">
 
  <h1 class="heading-title">our service</h1>
   
  <div class="box-container">

   <div class="box">
     <img src="adventure.png" alt="" >
     <h3 >adventure</h3>
   </div>

   <div class="box">
    <img src="tour-guide.png" alt="">
    <h3>tour guide</h3>
   </div>

   <div class="box">
    <img src="hiking.png" alt="" >
    <h3>trekking</h3>
   </div>

   <div class="box">
    <img src="bonfire.png" alt="">
    <h3>camp fire</h3>
   </div>

   <div class="box">
    <img src="jeep.png" alt="">
    <h3>off road</h3>
   </div>

   <div class="box">
    <img src="tent.png" alt="">
    <h3>camping</h3>
   </div>

  </div>

</section>

<!-- service section ends-->


<!-- home about starts-->

<section class="home-about">

    <div class="image">
      <img src="11.jpg" alt="">
    </div>

    <div class="content">
      <h3>about us</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, doloremque excepturi sed eos architecto neque molestias assumenda quam repudiandae, reiciendis totam, quis vel deleniti possimus aspernatur quibusdam itaque odit quasi!</p>
      <a href="about.php" class="btn">read more</a>
    </div>
</section>

<!-- home about ends-->


<!-- home packages section starts-->

<section class="home-packages">
    <h1 class="heading-title">our packages</h1>

    <div class="box-container">

      <div class="box">
          <div class="image">
              <img src="22.jpg" alt="">
          </div> 
          <div class="content">
          <h3>adventure and tour</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi nihil provident eveniet dolor ipsam deleniti tenetur! Eligendi sequi quidem deleniti, possimus numquam autem cum excepturi, facilis, nam aliquam animi reiciendis!</p>
          <a href="book.php" class="btn">book now</a>
           </div>
      </div>

      <div class="box">
          <div class="image">
              <img src="33.jpg" alt="">
          </div> 
          <div class="content">
          <h3>adventure and tour</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi nihil provident eveniet dolor ipsam deleniti tenetur! Eligendi sequi quidem deleniti, possimus numquam autem cum excepturi, facilis, nam aliquam animi reiciendis!</p>
          <a href="book.php" class="btn">book now</a>
           </div>
      </div>

      <div class="box">
          <div class="image">
              <img src="44.jpg" alt="">
          </div> 
          <div class="content">
          <h3>adventure and tour</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi nihil provident eveniet dolor ipsam deleniti tenetur! Eligendi sequi quidem deleniti, possimus numquam autem cum excepturi, facilis, nam aliquam animi reiciendis!</p>
          <a href="book.php" class="btn">book now</a>
           </div>
      </div>

    </div>

    <div class="load-more"><a href="package.php" class="btn">load more</a></div>
</section>

<!-- home packages section ends-->



<!-- home offer section starts-->

          










 <!-- home offer section ends-->





















<!-- footer section starts-->

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
<!-- footer section starts-->









<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="script.js"></script>



<!-- Chatbot UI -->
<style>
  /* Chatbot container */
  #chatbot-container {
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 350px;
    max-height: 450px;
    background: white;
    border: 1px solid #8e44ad;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    border-radius: 10px;
    z-index: 10000;
    flex-direction: column;
    font-family: 'Poppins', sans-serif;
  }

  /* Chatbot header */
  #chatbot-header {
    background-color: #8e44ad;
    color: white;
    padding: 10px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  #chatbot-header h4 {
    margin: 0;
    font-size: 1.6rem;
  }

  #chatbot-close-btn {
    background: transparent;
    border: none;
    color: white;
    font-size: 1.8rem;
    cursor: pointer;
  }

  /* Chat messages area */
  #chatbot-messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    font-size: 1.4rem;
    background: #f9f9f9;
  }

  /* Chat message bubbles */
  .chatbot-message {
    margin-bottom: 10px;
    padding: 8px 12px;
    border-radius: 15px;
    max-width: 80%;
    word-wrap: break-word;
  }

  .chatbot-message.user {
    background-color: #8e44ad;
    color: white;
    align-self: flex-end;
  }

  .chatbot-message.bot {
    background-color: #e0e0e0;
    color: #333;
    align-self: flex-start;
  }

  /* Chat input form */
  #chatbot-form {
    display: flex;
    border-top: 1px solid #8e44ad;
  }

  #chatbot-input {
    flex: 1;
    padding: 10px;
    font-size: 1.4rem;
    border: none;
    border-radius: 0 0 0 10px;
    outline: none;
  }

  #chatbot-form button {
    background-color: #8e44ad;
    color: white;
    border: none;
    padding: 0 20px;
    font-size: 1.4rem;
    cursor: pointer;
    border-radius: 0 0 10px 0;
  }

  /* Chat toggle button */
  #chatbot-toggle-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #8e44ad;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 1.6rem;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 10000;
  }
</style>

<div id="chatbot-container" aria-live="polite" aria-relevant="additions" role="log" aria-label="Chatbot window">
    <div id="chatbot-header">
        <h4>Chatbot</h4>
        <button id="chatbot-close-btn" aria-label="Close chatbot">&times;</button>
    </div>
    <div id="chatbot-messages"></div>
    <form id="chatbot-form" aria-label="Chatbot input form">
        <input type="text" id="chatbot-input" placeholder="Type your message..." autocomplete="off" required aria-required="true" />
        <button type="submit" aria-label="Send message">Send</button>
    </form>
</div>

<button id="chatbot-toggle-btn" title="Chat with us!" aria-label="Open chatbot">Chat</button>

<script>
    // Chatbot toggle
    const chatbotToggleBtn = document.getElementById('chatbot-toggle-btn');
    const chatbotContainer = document.getElementById('chatbot-container');
    const chatbotCloseBtn = document.getElementById('chatbot-close-btn');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotForm = document.getElementById('chatbot-form');
    const chatbotInput = document.getElementById('chatbot-input');

    chatbotToggleBtn.addEventListener('click', () => {
        chatbotContainer.style.display = 'flex';
        chatbotToggleBtn.style.display = 'none';
        chatbotInput.focus();
    });

    chatbotCloseBtn.addEventListener('click', () => {
        chatbotContainer.style.display = 'none';
        chatbotToggleBtn.style.display = 'block';
    });

    // Function to append message
    function appendMessage(sender, text) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('chatbot-message', sender);
        messageDiv.textContent = text;
        chatbotMessages.appendChild(messageDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    // Handle form submit
    chatbotForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const userMessage = chatbotInput.value.trim();
        if (!userMessage) return;
        appendMessage('user', userMessage);
        chatbotInput.value = '';
        appendMessage('bot', 'Typing...');

        try {
            const response = await fetch('chatbot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message: userMessage })
            });
            const data = await response.json();
            chatbotMessages.lastChild.textContent = data.reply || 'Sorry, no response.';
        } catch (error) {
            chatbotMessages.lastChild.textContent = 'Error communicating with chatbot.';
        }
    });
</script>

</body>
</html>
