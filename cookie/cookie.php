<?php

if(isset($_COOKIE['who'])) {
  if ($_COOKIE['who'] == md5("admin")){ #관리자 쿠키 있을때
    $_SESSION['id'] = "admin";
  }
}

//쿠키가 존재 하지 않고 세션아이디가 없을 경우. 낯선 방문객으로 쿠키 생성
if(!isset($_COOKIE['who']) and !isset($_SESSION['id'])){
  $cookieName = "who";
  $whois = md5("stranger");
  // $whois = "stranger";

//---> 쿠키 삭제 시간 : 자정시 쿠키 삭제.<---//
// 1.현재 now 초로 구하기.
// 2.내일 날짜 초로 구하기.
// 3.내일 날짜 초에서 현재 초 빼기. -> gap 변수에 저장
// 4.쿠키에 time()+gap 해준다.

$now = strtotime("now"); // 1. 현재 시간 초.

$date = date("Ymd");
$next = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($date))); //내일 날짜
$nextTime = strtotime($next); // 2 .내일 날짜 초
$gap = $nextTime - $now; // 3. gap
setcookie($cookieName,$whois,time()+$gap,"/"); // 4. add

if(!isset($_SESSION['indb'])){   //세션 없으면.
  $_SESSION['indb']= False;  // 세션 추가.
  }

}
 ?>
