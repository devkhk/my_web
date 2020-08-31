<?php
session_start();
include '../cookie/cookie.php';
include '../cookie/visitor.php';
include '../action/connect_db.php';
include '../action/paging.php';
// include_once './aciton/dummy.php';


 ?>
<!DOCTYPE html>
<html lang="utf-8">
<head>
  <meta charset="utf-8">
  <title>KHK_BLOG</title>
  <link rel="stylesheet" href="./css/blog.css">
  <link rel="stylesheet" href="./css/blog_paging.css">

  <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
  <index id="index"></index>
  <div class="title">
    <h1>Blog</h1>
  </div>
  <?php
  if(isset($_SESSION['id'])){
  ?>
  <a class="add_blog" href="new_blog.php">[새글 작성하기]</a>
  <?php
  }
   ?>
  <div id="columns">
    <?php
    $num_sql = "SELECT * FROM board ORDER BY num DESC";
    $data = $dbConnect->query($num_sql);
    $data_num = mysqli_num_rows($data);  //페이징에 필요한 데이터  총 개수.

    $paging = new Paging(9,10,$data_num);

    //페이징 예외처리.
    if($paging->page > $paging->total_page){
      ?>
      <script>
      alert("존재하지 않는 페이지 입니다.");
      // location.replace('./blog.php');
      window.history.back();
      </script>
      <?php
    }
    //게시글 뿌리기.
    // $list_sql = "SELECT *from board ORDER BY num DESC"; //DB저장된 게시글 목록 불러오기.
    $list_sql = $paging->set_page_sql("board","num",$paging->start_list, $paging->list);
    $result = $dbConnect->query($list_sql);
    while ($rows = mysqli_fetch_assoc($result)) {

      $content = $rows['content'];
      $res = mb_strpos($content,'<img');

      if($res === false){ //content 내용에 이미지 소스가 없으면
        $thumbnail = "./img-thumbnail/thumbnail.jpg";

      }else{ //이미지 소스 있으면

        $startStr = $res+29; //이미지 태그 안의 파일명 시작
        $resEnd = mb_strpos($content,'.',$startStr); //파일 명. (이미지확장자 앞까지가 파일명)
        $lastStr = $resEnd - $startStr;  //주소열 글자수
        $src = mb_substr($content,$startStr,$lastStr); //이미지 주소 글자수에 맞게 뽑아내기.

        $thumbnail = "../blog/img-thumbnail/".$src."_thumb.jpg"; //썸네일 경로.
  }

?>
       <!-- 게시글 제목,정보 -->
    <figure>
      <img class="figureImage" name="<?php echo $src; ?>" src="<?php echo $thumbnail; ?>" onclick="location.href='load_blog.php?num=<?php echo $rows['num'] ;?>'">
      <figcaption> <strong><?php echo $rows['title'] ;?></strong> </figcaption>
    </figure>

    <?php
  }
?>
  </div>
  <div id="blog_paging">
    <ul>
      <?php
      $paging->show_paging($paging->page, $paging->block_start, $paging->block_end, $paging->block_now, $paging->total_page, $paging->total_block );
      mysqli_close($dbConnect);
        ?>
    </ul>
  </div>
  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="../index/js/load_index_nav.js"></script>

</body>

</html>
