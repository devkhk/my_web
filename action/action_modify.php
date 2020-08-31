<?php

include '../action/connect_db.php';

$num = $_POST['num'];  //이전페이지에서 테이블 넘버 받아오기.
$pageCheck = $_POST['checkPage']; //페이지 구분 값 타임라인 :timeline 블로그 :blog

$title = $_POST['textarea_title']; //제목
$content = $_POST['editordata'];   //내용


switch ($pageCheck) {
  case 'blog': //blog

    $date = date('Y-m-d H:i');
    $URL = '../blog/blog.php';
    $sql = "update board set title='$title', content='$content', date='$date' WHERE num=$num;";
    $successMessage = "블로그를 수정했습니다.";
    $failMessage = "블로그를 수정 할 수 없습니다.";

    break;

  case 'timeline': //timeline

    $orign = $_POST['datepicker'];
    $date = date($orign);

    $URL = '../timeLine/timeline.php';
    $sql = "update timeline set title='$title', content='$content', date='$date' WHERE num=$num;";
    $successMessage = "타임라인을 수정했습니다.";
    $failMessage = "타임라인을 수정 할 수 없습니다.";

    break;
}

$result = $dbConnect->query($sql);

if($result){
?><script>
  alert("<?php echo $successMessage; ?>");
  location.replace("<?php echo $URL;?>");
</script>
<?php
}else{
  ?>
  <script>
  alert("<?php echo $failMessage ?>");
  history.back();

  </script>

<?php
}
mysqli_close($dbConnect);
 ?>
