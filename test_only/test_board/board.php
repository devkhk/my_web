<?php
$server_root = $_SERVER['DOCUMENT_ROOT'];
include $server_root.'/action/connect_db.php';
include $server_root.'/action/paging.php';
// include $server_root.'/consol_log.php';
// include_once '../action/test_board_action.php'; ##더미데이터 추가

 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>게시판</title>
     <link rel="stylesheet" href="./css/style.css">
     <link rel="stylesheet" href="./css/paging.css">
   </head>
   <body>
     <div id="board_area">
       <h1>자유게시판</h1>
       <h4>자유롭게 글을 쓸 수 있는 게시판</h4>
        <table class="list-table">
          <thead>
            <tr>
              <th width="70">번호</th>
              <th width="500">제목</th>
              <th width="120">글쓴이</th>
              <th width="100">작성일</th>
              <th width="100">조회수</th>
            </tr>
          </thead>
          <?php
          // if(isset($_GET['page'])){     //페이지 넘버 변수
          //   $page = $_GET['page'];
          // }else{
          //   $page = 1;    //없으면 1
          // }

          // $sql = "SELECT * FROM test_board";
          // $result = $dbConnect-> query($sql);
          // $row_num = mysqli_num_rows($result); //게시판 총 레코드 수
          //
          // $list = 10; //한 페이지에 보여줄 데이터 개수
          // $block = 10; //블록당 보여줄 페이지 개수.
          //
          // $block_num = ceil($page / $block); // 현재 페이지의 블록 구하기.
          // $block_start = ($block_num - 1) * $block + 1; //블록의 시작 페이지 번호.
          // $block_end = $block_start + $block - 1; //블록의 마지막 페이지 번호.
          //
          // $total_page = ceil($row_num / $list); //전체 페이지의 수
          // if($block_end > $total_page){
          //   $block_end = $total_page;   // 만약 블록의 마지막 페이지가 전체 페이지보다 넘으면 같게 한다.
          // }
          // $total_block = ceil($total_page/$block); // 블록의 총 개수.
          //
          // $start_list = ($page-1) * $list; //db에서 페이지로 가져올 맨 처음 넘버링.
          // $list_sql = "SELECT *from test_board ORDER BY no DESC LIMIT $start_list,$list"; ##테이블에서 가져온 no 기준으로 내림차순 $list개수만큼 표시

          $num_sql = "SELECT no From test_board ORDER BY no DESC" ;
          $data = $dbConnect-> query($num_sql);
          $data_num = mysqli_num_rows($data);

          $paging = new Paging(10,10,$data_num);


          $list_sql = $paging-> set_page_sql("test_board","no",$paging->start_list, $paging->list);
          $result = $dbConnect -> query($list_sql);
            while($rows = $result->fetch_array()){
              $title = $rows['title'];
              if(strlen($title) > 30){ //30글자 이상 뒤에 ...표시
                $title = str_replace($rows['title'],mb_substr($rows['title'],0,30,"utf-8")."...",$rows['title']);
              }
          ?>
          <tbody>
            <tr>
              <td with="700"><?php echo $rows['no'] ?></th>
              <td with="500"> <a href=""><?php echo $title; ?></a> </th>
              <td with="120"><?php echo $rows['writer']; ?></th>
              <td with="100"><?php echo $rows['date']; ?></th>
              <td with="100"><?php echo $rows['click']; ?></th>
            </tr>
          </tbody>
          <?php
            }
           ?>
        </table>
        <!-- 페이징 넘버 -->
        <div id="page_num">
          <ul>
            <?php
            $paging-> show_paging($paging->page, $paging->block_start, $paging->block_end, $paging->block_now, $paging->total_page, $paging->total_block );

            mysqli_close($dbConnect);
              ?>
          </ul>
        </div>
       <div id="write_btn">
         <a href=""> <button type="button" name="button">글쓰기</button></a>
       </div>
     </div>
   </body>
 </html>
