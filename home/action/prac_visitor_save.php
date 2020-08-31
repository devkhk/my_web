<?php
include '../action/connect_db.php';

$whois = array();

$whois[0] = md5("interested");
$whois[1] = md5("stranger");
$whois[2] = md5("wayfarer");


for ($i=0; $i < 10; $i++) {

  $r = mt_rand(0,2);
  $who = $whois[$r];

  $y = mt_rand(2018,2020);
  $m = mt_rand(1,12);
  $d = mt_rand(1,31);
  $H = mt_rand(0,24);
  $I = mt_rand(0,60);
  $s = mt_rand(0,60);

  $date = date("$y-$m-$d $H:$I:$s");
  $sql = "insert into admin_visitor (count, who, date) value(null,'$who','$date');"; // 따옴표를 넣자 하하!
  $result = $dbConnect-> query($sql);

}

mysqli_close($dbConnect);
 ?>
