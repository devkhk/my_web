<?php
include '../action/connect_db.php';

if(!isset($_COOKIE['who'])){
  $whois = md5("stranger");
}else{
  $whois = $_COOKIE['who'];
}

if($whois != md5("admin") and isset($_SESSION['indb'])){ //관리자가 아니고 , indb 세션이 존재하면서 그 값이 false 경우.

  if($_SESSION['indb'] == False){

    $date = date('Y-m-d H:i:s');
    $sql = "insert into admin_visitor (count, who, date) value(null,'$whois','$date');"; // 따옴표를 넣자 하하!
    $result = $dbConnect-> query($sql);

    $_SESSION['indb'] = True; //세션 값을 바꿔준다.
  }

}

mysqli_close($dbConnect);

?>
