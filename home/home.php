<!DOCTYPE html>
<?php
session_start();
include '../cookie/cookie.php';
include '../cookie/visitor.php';
// include '../home/action/prac_visitor_save.php'; 방문자 임시db 용
include '../action/connect_db.php';


$sql = "select count(*) from admin_visitor;";
$result = $dbConnect-> query($sql);
$row= mysqli_fetch_row($result);
$visitCount = $row[0];

mysqli_close($dbConnect);
 ?>
<html lang="utf-8">
<head>
  <meta charset="utf-8">
  <title>KHK's Portfolio Site</title>
  <link rel="stylesheet" href="./css/home.css">
  <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
  <div id="index"></div><br><br><br>

  <section class="home">
    <p target="_blank">반갑습니다! 김광현의 포트폴리오 사이트입니다!</p>

    <?php
    if(isset($_SESSION['id'])){
    ?>
    <a id="logout" href="../action/logout.php">LOGOUT</a><br>
    <a id="manage" href="../manage/manage.php">ADMIN</a>
    <?php
  }else{
    ?>
    <a id="login" href="../action/login.php">LOG IN</a>
    <?php
  }
     ?>
  </section>

  <div class="visitor">
    <p class="set">현재까지</p>
    <p class="count"><?php echo $visitCount; ?></p>
    <p class="desc">명이 방문했습니다.</p>
  </div>

  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="../index/js/load_index_nav.js"></script>
</body>

</html>
