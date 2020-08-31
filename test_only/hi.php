
<?php
include '../action/connect_db.php';

$sql = "select date from timeline order by date;";
$result = $dbConnect->query($sql);

$dateArray = array(); //날짜 데이터 저장할 어레이 변수.

$i = 0; //반복문을 통해서 어레이 변수에 날짜 저장.
while($row = mysqli_fetch_assoc($result)){

  $orign = $row['date'];
  $orign = date_create(substr($orign,0,-9)); //날짜 양식맞게 자르기.

  $date = date_format($orign,"Y-n-j");

  // $dateTime = DateTime::createFromFormat("Y-m-d",$content);
  // $date = date("Y-n-j",$date);

  $dateArray[$i]= $date;
  $i++;
}

$_POST = $dateArray;

phpinfo();

 ?>
<script>
var dateArray = <?php echo json_encode($_POST);?>; //js가 변수 데이터 값들을 가지고 올수 있게 json형식으로 인코딩
alert(dateArray);
</script>


<!DOCTYPE html>
<html lang="utf-8" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Something</title>
    <link rel="stylesheet" type="text/css" href="hi.css?ver=1" />
  </head>
  <body>
    <h1 id="title" class="btn">This Work!</h1>
    <script src="hi.js?ver=1"></script>
  </body>
</html>
