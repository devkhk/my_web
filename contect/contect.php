<?php
session_start();
include '../cookie/cookie.php';
include '../cookie/visitor.php';
 ?>
<!DOCTYPE html>
<html lang="utf-8">

<head>
  <meta charset="utf-8">
  <title>Contct KHK</title>
  <link rel="stylesheet" href="./css/contect.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <link rel="icon" href="data:;base64,iVBORw0KGgo=">
  <script type="text/javascript">
  function FormSubmit(){
    if (grecaptcha.getResponse() ==""){
      return false;
    }else{
      return true;
    }
  }

  </script>
</head>

<body>

  <div class="main">
    <div class="bio"><img class="profile-img" src="./images/profile.jpg" />
      <h3 class="header">김광현<br>KwangHyeon Kim</h3>
      <p>Full-Stek developer. I'm interested in design, performance & the future of DeepLearning...</p>
      <a class="bio-link" href="https://kidneydonor.tistory.com">Tistory<i class="fas fa-blog"></i></a>
      <a class="bio-link" href="#">Github<i class="fab fa-github"></i></a>
    </div>

<index id="index"></index>

    <div class="contact">
      <form id="form" action="./action/send-mail.php" method="post" onsubmit="return FormSubmit();">
        <legend class="header">Get In Touch</legend>
        <fieldset>
          <label class="fa fa-user" for="name-input" aria-hidden="true"></label>
          <input type="text" placeholder="Your name..."id="name-input" required name="name" />
        </fieldset>
        <fieldset>
          <label class="fa fa-envelope" for="email-input" aria-hidden="true"></label>
          <input type="email" placeholder="Your email..." id="email-input" required name="email" />
        </fieldset>
        <fieldset>
          <label class="fa fa-comment" for="message-input" aria-hidden="true"></label>
          <textarea placeholder="Your Message..." id="message-input" required name="message"></textarea>
        </fieldset>
        <fieldset>
          <div class="g-recaptcha" data-sitekey="6Lc6r94UAAAAADma6UNSfiuc_u-OAxkRBHerfwWA"></div>
        </fieldset>
        <fieldset>
          <button type="submit" id="btn-submit">Send</button>
        </fieldset>
      </form>
    </div>
  </div>

  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="./js/contect.js"></script>
  <script src="../index/js/load_index_nav.js"></script>

</body>

</html>
