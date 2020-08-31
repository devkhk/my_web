<?php
session_start();
include '../cookie/cookie.php';
include "../action/connect_db.php";

$number = $_GET['num'];
// $checkSql = "select num from board"

// 데이터 가지고오기. 예외처리. 없는 $number -> 블로그 탭으로 가기.
$sql = "select title, content, date, hit from board where num = '$number';";
$result = $dbConnect-> query($sql);        ///???reusult는 한번쓰이고 끝?
$check_result = $dbConnect-> query($sql);

//없는 게시글 예외처리. 블로그 페이지로 돌아가기.
if(empty(mysqli_fetch_assoc($check_result))){
?>
<script>
alert("없는 게시글 입니다.");
location.replace('../blog/blog.php');
</script>
<?php
}

$rows = mysqli_fetch_assoc($result);

$title =  $rows['title']; //제목
$content = $rows['content']; //내용

//날짜 편집. 0000-00-00 00:00:00

$year = substr($rows['date'],0,4);
$month= substr($rows['date'],5,2);
$day= substr($rows['date'],8,2);
$time = substr($rows['date'],-8,-3);

$date = $year.". ".$month.". ".$day.".&nbsp;&nbsp;".$time; //ex)2020.02.25 12:04

 ?>

<!DOCTYPE html>
<html lang="utf-8">
  <head>
    <meta charset="utf-8">
    <title>KHK_BLOG</title>
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800&display=swap&subset=korean" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="./css/load_blog.css">
  </head>
  <body>
    <a id="top-button"></a>
    <div class="blog_page">
      <div class="aticle_skin">

        <header class="blog_header">
            <strong class="blog_tag"> <a href="blog.php" class="title_tag">Blog</a> </strong>

          <!-- 헤더  : 제목.날짜 -->
          <div class="blog_title">
            <?php echo $title; ?>
          </div>
          <div class="blog_date"
            KHK <span class="text_bar" ></span> <?php echo $date ?>
          </div>
        </header>

        <!-- !!세션 관리때 수정!! 수정 / 삭제  -->
        <?php
        if(isset($_SESSION['id'])){
        ?><div class="admin_manage">
          <strong><a href="modify_blog.php?num=<?php echo $number;?>">수정</a></strong> <span class="text_bar"></span>
          <strong><a href="../action/delete_check.php?num=<?php echo $number;?>&page=blog">삭제</a></strong>
        </div>
        <?php
        }
         ?>

          <!-- 아티클 : 블로그 내용 -->
          <article class="blog_content">
            <?php echo $content; ?>
          </article>

            <!-- 댓글섹션 disqus -->
          <section class="commments">
            <div id="disqus_thread"></div>
              <script src="./js/blog_comments.js"></script>

              <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
          </section>


    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../blog/js/top_button.js?ver=1"></script>


  </body>
</html>
