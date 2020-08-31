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

$num = $_POST['num']; //테이블 삭제 넘버
$checkPage = $_POST['checkPage']; //페이지 확인
$checkPassword = sha1($_POST['loginPW']);//비밀번호 확인

//페이지 체크.
switch ($checkPage) {
  case 'blog':
    $URL = '../blog/blog.php';
    $deleteSql = "delete from board where num=$num;";
  break;

  case 'timeline':
    $URL = '../timeLine/timeline.php';
    $deleteSql = "delete from timeline where num=$num;";
  break;

  default:
    $URL="../home/index.html";
  ?>
  <script>
    alert("<?php echo "알 수 없는 게시글입니다." ?>");
    location.replace("<?php echo $URL;?>");
  </script>
  <?php
  break;
}

//비밀번호 확인하기.
$adminSql = "select * from identify where password='$checkPassword'";
$checkResult = $dbConnect->query($adminSql);
$row = mysqli_fetch_assoc($checkResult);


//비밀번호 일치시 삭제.
if($checkPassword == $row['password']){
  $dbConnect->query($deleteSql);
?>
<script>
  alert("<?php echo "게시글을 삭제했습니다." ?>");
  location.replace("<?php echo $URL?>");
</script>
<?php
}else{
  ?>
  <script>
  alert("<?php echo "비밀번호가 일치하지 않습니다!" ?>");
  history.back();
  </script>

<?php
}
mysqli_close($dbConnect);
 ?>
