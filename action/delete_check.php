<?php
session_start();

if(!isset($_SESSION['id'])){ //세션이 없거나 만료.
?>
<script>
window.location.href="../blog/blog.php";
</script>
<?php
}

//세션추가 해야함함함하맘

include '../action/connect_db.php';

$num = $_GET['num'];
$checkPage = $_GET['page'];
$message=""; // 타임라인/블로그 구별 메시지.


//없는 게시글 예외처리.
switch ($checkPage) {
  case 'timeline':

  $message = "타임라인";
  //블로그 테이블 넘버 존재 확인.
  $sql = "select num from timeline where num = '$num';";
  $result = $dbConnect-> query($sql);

  //블로그 게시물이 없을 시 블로그 페이지로 가기.
  if(empty(mysqli_fetch_assoc($result))){
  ?>
  <script>
  alert("없는 타임라인 입니다.");
  location.replace('../timeLine/timeline.php');
  </script>
  <?php
  }
    break;

  case 'blog':
  $message = "블로그";

  //블로그 테이블 넘버 존재 확인.
  $sql = "select num from board where num = '$num';";
  $result = $dbConnect-> query($sql);

  //블로그 게시물이 없을 시 블로그 페이지로 가기.
  if(empty(mysqli_fetch_assoc($result))){
  ?>
  <script>
  alert("없는 블로그 입니다.");
  location.replace('../blog/blog.php');
  </script>
  <?php
  }
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


 ?>

 <html lang="utf-8" >
   <head>
     <meta charset="utf-8">
     <title>삭제 확인</title>
     <link rel="stylesheet" href="../action/css/login.css">
   </head>
   <body>
     <div class="login">
      <h3><?php echo $message;?> 게시글을 삭제하려면 <br>비밀번호를 입력해 주세요.</h3>
         <form action="../action/action_delete.php" method="post">
           <input type="hidden" name="num" value="<?php echo $num; ?>">
           <input type="hidden" name="checkPage" value="<?php echo $checkPage; ?>">
             <input type="password" name="loginPW" placeholder="Password" required="required" />
             <button type="submit" class="btn btn-primary btn-block btn-large"><?php echo $message;?> 게시글을 삭제합니다.</button>
         </form>
     </div>
   </body>
 </html>
