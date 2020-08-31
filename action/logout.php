<?php
session_start();

if($_SESSION['id']!= null){
  unset($_SESSION['id']); //세션 아이디 삭제.
  setcookie("who","",time()-1,"/");
}
echo "<script>location.href='../home/whoru.php';</script>";
 ?>
