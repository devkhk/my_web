<?php
session_start();
include ('../cookie/cookie.php');
if($_COOKIE['who'] != md5("admin") or !isset($_SESSION['id'])){
?>
<script>
location.replace('blog.php');
</script>
<?php
}
 ?>

<!DOCTYPE html>
<html lang="utf-8">
  <head>
    <meta charset="utf-8">
    <title>새로운 블로그 작성</title>
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
      새로운 블로그 글 작성하기
    </center></h1>

    <form class="new-post" action="../action/action_write.php" method="post">
      <input type="hidden" name="checkPage" value="0">
      <div class="post-title">
        <textarea class="textarea_title" name="textarea_title" required="required" placeholder="제목을 입력하세요"></textarea>
      </div>
    <div class="post-main">
      <textarea class="textarea_main" name="editordata" required="required" id="summernote"></textarea>
    </div>
    <input class="btn-submit"type="submit" value="작성">
    </form>

    <script src="./js/summernote.js"></script>
  </body>
</html>
