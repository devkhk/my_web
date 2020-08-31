<?php
session_start();
include ("../action/connect_db.php");

$id = $_POST['loginID'];
$pw = sha1($_POST['loginPW']);
// $pw = $_POST['loginPW'];

$sql= "select * from identify where id='$id'and password='$pw' ";
$result = $dbConnect->query($sql);

$row = mysqli_fetch_array($result);

if($id == $row['id'] && $pw == $row['password']){ //입력한 아이디와 비밀번호가 일치할 때.
  $_SESSION['id'] = "admin"; //관리자 세션 아이디 등록
  $_SESSION['indb'] = True ; //디비 저장 필요없음.

  $now = strtotime("now"); // 1. 현재 시간 초.
  $date = date("Ymd");
  $next = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($date))); //내일 날짜
  $nextTime = strtotime($next); // 2 .내일 날짜 초
  $gap = $nextTime - $now; // 3. gap

  setcookie("who",md5("admin"),time()+$gap,"/"); #쿠키 삭제 시간 -> 정각 이후 쿠키 삭제.

  echo "<script>location.href='../home/home.php';</script>";
}else{                                                      //입력한 아이디와 비밀번호가 일치 하지 않을 때.
  echo "<script>window.alert('잘못된 아이디 혹은 패스워드');</script>";
  echo "<script>location.href='login.php';</script>";
}

mysqli_close($dbConnect);

 ?>
