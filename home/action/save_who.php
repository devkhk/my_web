<?php
session_start();
$whois = md5($_POST['who']);

$now = strtotime("now"); // 1. 현재 시간 초.
$date = date("Ymd");
$next = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($date))); //내일 날짜
$nextTime = strtotime($next); // 2 .내일 날짜 초
$gap = $nextTime - $now; // 3. gap

if($whois == md5("admin")){ //관리자 확인.
?>
<script type="text/javascript">
location.href='/action/login.php';
</script>
<?php
}else{
setcookie("who",$whois,time()+$gap,"/"); //쿠키에 누구인지 저장 86400=1day

if(!isset($_SESSION['indb'])){   //세션 없으면.
  $_SESSION['indb'] = False;  // 세션 추가.
}

?>
<script type="text/javascript">
location.replace('../home.php');
</script>
<?php
}
 ?>
