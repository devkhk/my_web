<!DOCTYPE html>
<?php
session_start();


  //쿠키가 존재하면서 관리자가 아닐땐 못오게한다.  --> 쿠키가 없으면 들어올 수 있음.
  //쿠키가 삭제된(없는) 경우..-> 세션 아이디가 존재하면 관리자이므로 못오게 막고. 세션아이디가 없으면 처음 온사람으로 판단.
if(isset($_COOKIE['who'])){
  Header("Location:home.php");
}else{
  if(isset($_SESSION['indb'])){
    if($_SESSION['indb']==True)
      Header("Location:home.php");
    }
  }

 ?>

<html lang="utf-8">
<head>
  <meta charset="utf-8">
  <title>KHK's Portfilo Site</title>
  <link rel="stylesheet" href="./css/whoru.css?ver=1">
</head>

<body>
  <div class="background">
    <div class="blur">
      <h2>Who are you?</h2>
      <form class="who" action="./action/save_who.php" method="post">
        <input id="btn1" type="submit"  name="who" value="interested">
        <input id="btn2" type="submit"  name="who" value="stranger">
        <input id="btn3" type="submit"  name="who" value="wayfarer">
        <input id="btn4" type="submit"  name="who" value="admin">
      </form>
    </div>
  </div>
  <script src="./js/whoru.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>

</html>
