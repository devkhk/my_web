<!DOCTYPE html>
<?php session_start(); ?>
<html lang="utf-8" >
  <head>
    <meta charset="utf-8">
    <title>관리자 계정 로그인</title>
    <link rel="stylesheet" href="../action/css/login.css">
  </head>
  <body>
    <?php
    if(!isset($_SESSION['id'])){
    ?>
    <div class="login">
     <h1>Login</h1>
        <form action="login_check.php" method="post">
         <input type="text" name="loginID" placeholder="Username" required="required" />
            <input type="password" name="loginPW" placeholder="Password" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
    </div>
    <?php
  }else{ //세션 아이디가 있을 때.
    // echo "<a href='logout.php'>logout</a>";
    ?>
    <script type="text/javascript">
    location.replace('../home/home.php');
    </script>
    <?php
  }
   ?>

  </body>
</html>
