<?php
session_start();

if(!isset($_SESSION['id'])){ //세션이 없거나 만료.
?>
<script>
window.location.href="../blog/blog.php";
</script>
<?php
}

include '../action/connect_db.php';

$title = $_POST['textarea_title'];
$content = $_POST['editordata'];

// 블로그 작성하기인지, 타임라인 작성하기인지 구분하기 위한 변수
// 1이 넘어오면 타임라인 작성, 0이 넘어오면 블로그 글 작성
$checkPage = $_POST['checkPage'];

if($checkPage==0){
  include '../action/make_thumbnail.php';      //썸네일 이미지 만들기.
  $date = date('Y-m-d H:i');
  $URL = '../blog/blog.php';
  $sql = "insert into board (num, title, content, date, hit) value(null,'$title','$content','$date',0);";
  $successMessage = "새 글이 등록되었습니다.";
  $failMessage = "게시글을 작성 할 수 없습니다.";
}else{
  $date = $_POST['datepicker'];
  // $date = date($orign);

  $URL = '../timeLine/timeline.php';
  $sql = "insert into timeline (num, title, content, date) value(null,'$title','$content','$date');";
  $successMessage = "새로운 타임라인을 작성했습니다.";
  $failMessage = "타임라인을 작성 할 수 없습니다.";
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
  alert("<?php echo $failMessage; ?>");
  location.replace("<?php echo $URL ?>");

  </script>

<?php
}
mysqli_close($dbConnect);
 ?>
