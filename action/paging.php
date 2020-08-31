<?php
// $server_root = $_SERVER['DOCUMENT_ROOT'];
// include $server_root.'/consol_log.php';
// include $server_root.'/action/connect_db.php';


class Paging {

  ## 페이징에 필요한 요소
  // 1. 총 데이터 수
  // 2. 한 화면에 보여줄 데이터 수
  // 3. 페이지블록 단위 (한 블록 당 페이지 수)
  // public $sql;
  // public $data;
  public $total_rows;

  public $list;
  public $block ;
  public $page;
  public $total_page;
  public $block_now;
  public $block_start;
  public $block_end;
  public $total_block;
  public $start_list;

  public function __construct($list,$block,$total_rows){
    # 1.총 데이터 수
    // $sql = "SELECT no From test_board ORDER BY no DESC" ;
    // $data = $dbConnect-> query($sql);
    // $this->$total_rows = mysqli_num_rows($data);
    $this->total_rows = $total_rows;


    # 2. 한 화면에 보여줄 데이터 수 (페이지당 데이터 수)
    $this->list =$list;

    # 3. 페이지 블록 단위
    $this->block =$block;

    #현재 페이지
    if(isset($_GET['page'])){
      $this->page = $_GET['page'];
    }else{
      $this->page = 1;
    }

    /*
    블록과 페이지에 필요한 변수 설정

     //구하는 순서//

    현재 페이지

    현재페이지의 블록넘버
    블록의 시작 페이지 번호
    블록의 마지막 페이지 번호

    전체 페이지 수
    총 블록의 수

    ---> db에서 가지고 올 리스트의 첫번째 수
    */

    /*블록*/

    # 현재 페이지 블록 구하기
    $this->block_now = ceil($this->page/$this->block);

    # 블록의 시작 페이지 번호. 1/ 11 / 21/ 31/ --- 등차수열 a + (n-1)*d
    $this->block_start = ($this->block_now - 1) * $this->block + 1;

    # 블록의 마지막 페이지 번호 10/ 20 / 30/ 40 ---
    $this->block_end = $this->block * $this->block_now ;
    // $block_end = $block_start + $block - 1;


    /* 페이지 */
    //전체 페이지, 총 블록 수

    # 전체 페이지 => 총 데이터 수 / 한 페이지에 보여줄 데이터 수
    $this ->total_page = ceil($this->total_rows / $this->list);
    if($this->block_end > $this->total_page) {
       $this->block_end = $this->total_page ;    //전체 페이지 수보다 블록의 마지막 페이지번호가 더 크면 같게 한다.
    }

    #총 블록 수
    $this->total_block = ceil($this->total_page / $this->block);

    #db에서 현재 페이지로 가지고 올 첫번째 리스트의 번호
    $this->start_list = ($this->page-1) * $this->list;

  }

  public function set_page_sql($board_name, $board_number, $start, $list){
    $sql = "SELECT * FROM $board_name ORDER BY $board_number DESC LIMIT $start, $list";
    return $sql;
  }


  public function show_paging($page, $block_start, $block_end, $block_now, $total_page, $total_block ){

    if($page <= 1){ //page가 1일때 처음 글자에 붉은표시.
      echo "<li class = 'font_red'>[처음]</li>";
    }else{
      echo "<li><a href='?page=1'>[처음]</a></li>"; //1이 아닐때 처음으로 돌아갈 수 있게 링크.
    }
    if($page > 1){
      $pre = $page-1; //이전으로 가기
      echo "<li><a href='?page=$pre'>[이전]</a></li>";
    }

    // 페이지 넘버링 //
    for ($i=$block_start; $i <= $block_end ; $i++) {
      if ($page == $i) {
        echo "<li class='font_red'>[$i]</li>";
      }else{
        echo "<li><a href='?page=$i'>[$i]</a></li>";
      }
    }

    if($block_now < $total_block){ //현재 블록의 넘버가 블록 총개수보다 작은 값이라면 [다음]버튼 생성.
      $next = $page + 1;
      echo "<li><a href='?page=$next'>[다음]</a></li>";
    }
    if($page >= $total_page){
      echo "<li class = 'font_red'>[마지막]</li>";
    }else{
      echo "<li>
      <a href='?page=$total_page'>[마지막]</a>
      </li>";
    }
  }
}

    // mysqli_close($dbConnect);
     ?>
