<?php

# $no
$title = "this is title 자유게시판입니다~";
$writer_array = array(
  "writer1",
  "writer2",
  "writer3"
);


for ($y = 2000; $y < 2020; $y++) { #임시데이터 추가량

    for ($m=1; $m < 13 ; $m++) {
      for ($d=1; $d < 32 ; $d++) {

        if($m == 2 && $d == 29 ){
          $m ++;
          $d = 1;
        }elseif ($m==4 or $m==6 or $m== 9 or $m== 11) { #13.89 #13.79 #13.80 #13.79
          if($d == 31 ){
            $m ++;
            $d = 1;
          }
        }
        // if($m==4 or $m==6 or $m== 9 or $m== 11){
        //   if($d == 31 ){  #13.94 #13.93 #13.73 #16.30 13.79 13.92
        //     $m ++;
        //     $d = 1;
        //   }
        // }

        $r = mt_rand(0,2);
        $writer = $writer_array[$r];

        $H = 0;
        $I = 0;
        $s = 0;

        $date = date("$y-$m-$d $H:$I:$s");

        $sql = "INSERT INTO test_board (no,title,writer,date)
        value(null,'$title','$writer','$date')";
        $result = $dbConnect->query($sql);

      }
    }

}

 ?>
