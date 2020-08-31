<?php

$orign = $_POST['datepicker'];
$day = date($orign);

$date = date("Ymd");
$next = date("Y-m-d H:i:s",strtotime("+1 day",strtotime($date)));

echo $date."today <br />";
echo $next."next <br />";

$now = strtotime("now");
$strNext = strtotime($next);

$gap = $strNext-$now;

$answer = time()+$gap;

echo $now."now <br />";
echo $strNext."next <br />";

echo $answer."<br />";

$sss = gmdate("Y-m-d H:i:s",$answer);

echo $sss;


// $orign =$_POST['datepicker'];
// $newDate = date('Y-m-d H:i:s',strtotime($orign));
//
// $years = substr($newDate,0,4);
// $month= substr($newDate,5,2);
// $day= substr($newDate,8,2);
//
// $date = $years."-".$month."-".$day;

 ?>
