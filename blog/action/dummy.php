<?php

$title = "dummy title";
$content = "dummy content";
for ($y = 2019; $y < 2020; $y++) { #임시데이터 추가량

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

        $H = 0;
        $I = 0;
        $s = 0;

        $date = date("$y-$m-$d $H:$I:$s");

        $sql = "INSERT INTO board (num,title,content,date)
        value(null,'$title','$content','$date')";
        $result = $dbConnect->query($sql);

      }
    }

}

 ?>
