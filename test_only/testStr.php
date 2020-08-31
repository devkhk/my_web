<?php

include "../action/connect_db.php";

$sql="select content from board where num=41;";
$result = $dbConnect->query($sql);
$rows = mysqli_fetch_assoc($result);

$content = $rows['content'];


$res = mb_strpos($content,'<img');

if($res === false){
  echo "not found";
}else{
  $startStr = $res+10; //이미지 태그 안의 주소 시작점
  $resEnd = mb_strpos($content,'"',$startStr); //주소 끝 쌍따옴표


  $lastStr = $resEnd - $startStr;  //주소열 글자수
  $sys = mb_substr($content,$startStr,$lastStr);

  echo $res."<br />";
  echo $resEnd."<br />";
  echo $sys;
}

 ?>
