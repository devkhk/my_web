<?php
session_start();

include '../cookie/cookie.php';
include '../cookie/visitor.php';
include "../action/connect_db.php";
include_once "./action/set_month.php"; //날짜 변환.


$sql = "select *from timeline order by date;";
$result = $dbConnect->query($sql);
$contentResult = $dbConnect->query($sql);

$dateSql = "select date from timeline order by date";
$dateResult = $dbConnect->query($dateSql);
// $rows = mysqli_fetch_assoc($result);

$firstSelected = 'class="selected"';

 ?>

<!DOCTYPE html>
<html lang="utf-8">

<head>
  <meta charset="utf-8">
  <title>KHK_TIMELINE</title>
  <link rel="stylesheet" href="./css/timeline_nav.css">
  <link rel="stylesheet" href="./css/timeline.css">
  <link rel="icon" href="data:;base64,iVBORw0KGgo=">
</head>

<body>
  <header>
    <div class="title">
      <h1>TimeLine</h1>
      <?php
      if(isset($_SESSION['id'])){
        ?>
        <div class="newTimeLine">
            <strong><a href="new_timeline.php">새로운 타임라인</a></strong>
        </div>
        <?php
      }
       ?>

    </div>
  </header>

    <!-- index -->
<index id="index"></index>

  <!-- horizontal timeline section -->
  <section class="cd-horizontal-timeline">
    <!-- vertical timeline navigation 사이드 세로 네비-->
    <div class="timeline-nav">
      <div>
        <?php

        function date_formet($rows){

          $form['years'] = substr($rows['date'],0,4);
          $form['month'] = substr($rows['date'],5,2);
          $form['day'] = substr($rows['date'],8,2);

          $form['date'] = $form['day']."/".$form['month']."/".$form['years']; //ex) dd/mm/yy

          return $form;
        }

        $i = 0;
        $secYears = 1970;
        while($rows = mysqli_fetch_assoc($dateResult)){

            $date = date_formet($rows);  //날짜 편집. 0000-00-00 00:00:00
            $month = set_month($date['month']); //월 변환
            /* ex
            month['half'] => Dec
            month['full'] => December
            */

            if($date['years'] != $secYears){  //2012 =! "" 년도 <li> 만들기.
              if($i==0){ //처음 클래스명 기준.
                ?>
                <li class="nav-years"><?php echo $date['years']; ?></li>
                <li class="nav-sub"><a href="#0" data-date="<?php echo $date['date']; ?>" <?php echo $firstSelected; ?>><?php echo $month['half']." ".$date['day'] ;?></a></li>
                <?php
                $i++;

              }else{
          ?>
              <li class="nav-years"><?php echo $date['years']; ?></li>
              <li class="nav-sub"><a href="#0" data-date="<?php echo $date['date']; ?>"><?php echo $month['half']." ".$date['day'] ;?></a></li>
          <?php    }
        }else{
          ?>
          <li class="nav-sub"><a href="#0" data-date="<?php echo $date['date']; ?>"><?php echo $month['half']." ".$date['day'] ;?></a></li>
          <?php
        }
        $secYears = $date['years'];
      } //nav wile

         ?>

      </div>
    </div>

    <!-- horizontal timeline navigation 가로 타임라인-->

    <div class="timeline">
      <div class="events-wrapper">
        <div class="events">
          <ol>
            <!-- <li><a href="#0" data-date="09/02/2012" class="selected">Feb 2012</a></li> -->
            <?php
          $j = 0;
          while ($rows=mysqli_fetch_assoc($result)) {

            $title = $rows['title']; //제목

            $date = date_formet($rows);  //날짜 편집. 0000-00-00 00:00:00
            $month = set_month($date['month']); //  월 변환.


            if($j==0){
            ?>
            <li><a href="#0" data-date="<?php echo $date['date']; ?>" <?php echo $firstSelected; ?>><?php echo $month['half']." ".$date['years'] ;?></a></li>

            <?php
            $j++;
          }else{
            ?>
            <li><a href="#0" data-date="<?php echo $date['date']; ?>"><?php echo $month['half']." ".$date['years'];?></a></li>
            <?php
          }
        }//while nav
           ?>
          </ol>
          <span class="filling-line" aria-hidden="true"></span>

        </div> <!-- .events -->
      </div> <!-- .events-wrapper -->

      <!-- 오른쪽 왼쪽 버튼 -->
      <ul class="cd-timeline-navigation">
        <li><a href="#0" class="prev inactive">Prev</a></li>
        <li><a href="#0" class="next">Next</a></li>
      </ul> <!-- .cd-timeline-navigation -->
    </div> <!-- .timeline -->
    <!-- event-content-->

    <!-- 내용 컨텐츠 -->
    <div class="events-content">
      <ol>
        <?php
      $k = 0;

      while ($rows=mysqli_fetch_assoc($contentResult)) {

        $title = $rows['title']; //제목
        $content = $rows['content']; //내용

        //날짜 편집. 0000-00-00 00:00:00
        $date = date_formet($rows);
        $month = set_month($date['month']); #월 변환.

        $num = $rows['num'];

        // ../blog/delete_check_Blog

        if($k==0){
      ?>
        <li <?php echo $firstSelected; ?> data-date="<?php echo $date['date']; ?>">
          <?php
          if(isset($_SESSION['id'])){
            ?>
            <div class="timeline_manage">
              <strong><span><a href="modify_timeline.php?num=<?php echo $num;?>">수정</a></span>
                <span><a href="../action/delete_check.php?num=<?php echo $num;?>&page=timeline">삭제</a></span></strong>
            </div>
            <?php
          }
           ?>

          <h2><?php echo $title; ?></h2>
          <em><?php echo $month['full'].", ".$date['years']; ?></em>
          <?php echo $content; ?>
        </li>
        <?php
          $k++;
        }else{
          ?>
        <li data-date="<?php echo $date['date']; ?>">
          <?php
          if(isset($_SESSION['id'])){
            ?>
            <div class="timeline_manage">
              <strong><span><a href="modify_timeline.php?num=<?php echo $num;?>">수정</a></span>
                <span><a href="../action/delete_check.php?num=<?php echo $num;?>&page=timeline">삭제</a></span></strong>
            </div>
            <?php
          }
           ?>
          <h2><?php echo $title; ?></h2>
          <em><?php echo $month['full'].", ".$date['years']; ?></em>
          <?php echo $content; ?>
        </li>
        <?php
        }
      }//while end
      mysqli_close($dbConnect);
       ?>
      </ol>
    </div> <!-- .events-content -->
  </section>

  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="./js/timeline.js"></script>
  <script src="../index/js/load_index_nav.js"></script>
</body>

</html>
