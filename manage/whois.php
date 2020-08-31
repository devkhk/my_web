<?php
include '../action/connect_db.php';

$whois[0] = md5("interested");
$whois[1] = md5("stranger");
$whois[2] = md5("wayfarer");

$count = array();

for ($i=0; $i < 3; $i++) {
  $sql = "select count(*) from admin_visitor where who='$whois[$i]';";
  $result = $dbConnect->query($sql);
  $row = mysqli_fetch_row($result);
  $count[$whois[$i]] = $row[0];
}

// $sqlInterested = "select count(*) from visit where who='interested';";
// $sqlStranger = "select count(*) from visit where who='stranger';";
// $sqlWayfarer = "select count(*) from visit where who='wayfarer';";
//
// $resultInterested = $dbConnect->query($sqlInterested);
// $resultStranger = $dbConnect->query($sqlStranger);
// $resultWayfarer = $dbConnect->query($sqlWayfarer);
//
// $rowInterested = mysqli_fetch_row($resultInterested);
// $rowStranger = mysqli_fetch_row($resultStranger);
// $rowWayfarer = mysqli_fetch_row($resultWayfarer);
//
// $whoInterested = $rowInterested[0];
// $whoStranger = $rowStranger[0];
// $whoWayfarer = $rowWayfarer[0];

mysqli_close($dbConnect);

 ?>
