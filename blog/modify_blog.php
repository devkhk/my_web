<?php
session_start();

if(!isset($_SESSION['id'])){ //세션이 없거나 만료.
  include '../cookie.php';
?>
<script>
window.location.href="../blog/blog.php";
</script>
<?php
}

include '../action/connect_db.php';

$num = $_GET['num']; //테이벌 넘버 받기.

$sql = "select *from board where num=$num"; // 해당 넘버 게시글 불러오기.
$result = $dbConnect->query($sql);

$rows = mysqli_fetch_assoc($result); //결과값 배열.

//불러올 제목. 게시글. 시간.
$title = $rows['title'];
$content = $rows['content'];

 ?>
 <!DOCTYPE html>
 <html lang="utf-8">
   <head>
     <meta charset="utf-8">
     <title>게시글 수정</title>
     <!-- include libraries(jQuery, bootstrap) -->
 <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
 <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

 <!-- include summernote css/js-->
 <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
 <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

 <link rel="stylesheet" href="./css/write_blog.css">
   </head>

   <body>
     <h1 class="page-title"><center>
       게시글 수정하기
     </center></h1>

     <form class="new-post" action="../action/action_modify.php" method="post">
       <input type="hidden" name="num" value="<?php echo $num;?>"> <!-- 히든으로 테이블 넘버를 넘겨준다. -->
       <input type="hidden" name="checkPage" value="blog"> <!-- 페이지 구분 값 블로그:0 | 타임라인:1 -->
       <div class="post-title">
         <textarea class="textarea_title" name="textarea_title" required="required" placeholder="제목을 입력하세요"><?php echo $title;?></textarea>
       </div>
     <div class="post-main">
       <textarea class="textarea_main" name="editordata" required="required" id="summernote"><?php echo $content; ?></textarea>
     </div>
     <input class="btn-submit"type="submit" value="수정">
     </form>

     <script src="../blog/js/summernote.js"></script>
   </body>
 </html>
