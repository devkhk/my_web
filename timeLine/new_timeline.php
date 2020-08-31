
<?php
include '../action/connect_db.php';

$sql = "select date from timeline order by date;";
$result = $dbConnect->query($sql);

$dateArray = array(); //날짜 데이터 저장할 어레이 변수.

$i = 0; //반복문을 통해서 어레이 변수에 날짜 저장.
while($row = mysqli_fetch_assoc($result)){

  $orign = $row['date'];
  $orign = date_create(substr($orign,0,-9)); //날짜 양식맞게 자르기.

  $date = date_format($orign,"Y-n-j"); //날짜 포맷 변경.

  $dateArray[$i]= $date;
  $i++;
}

$_POST = $dateArray;

 ?>

<!DOCTYPE html>
<html lang="utf-8">

<head>
  <meta charset="utf-8">
  <title>새로운 타임라인 작성</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- include libraries(jQuery, bootstrap) -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

  <link rel="stylesheet" href="../blog/css/write_blog.css">
</head>

<!-- body -->

<body>
  <h1 class="page-title">
    <center>
      새로운 타임라인 만들기
    </center>
  </h1>

  <article class="postData">
    <form class="new-post" action="../action/action_write.php" method="post">
      <input type="hidden" name="checkPage" value="1">
      <!-- YYYY-MM-DD -->
      <!-- <p>Date: <input type="date" required="required" name="datepicker"></p> -->
      <p>Date: <input type="text" name="datepicker" required="required" id="datepicker"></p>

      <div class="post-title">
        <textarea class="textarea_title" name="textarea_title" required="required" placeholder="제목을 입력하세요"></textarea>
      </div>
      <div class="post-main">
        <textarea class="textarea_main" name="editordata" required="required" id="summernote"></textarea>
      </div>

      <input class="btn-submit" type="submit" value="작성">
    </form>
  </article>

  <script src="../blog/js/summernote.js"></script>
  <script>
  var dateArray = <?php echo json_encode($_POST);?>; //js가 변수 데이터 값들을 가지고 올수 있게 json형식으로 인코딩

  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth:true,
      changeYear:true,
  		showOn:"both",
  		dateFormat: 'yy-mm-dd',
      beforeShowDay: disableAllTheseDays
    });
  } );

// var disabledDays = ["2020-7-9","2020-7-24","2020-7-26"];

  function disableAllTheseDays(date) {
	var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
	for (i = 0; i < dateArray.length; i++) {
		if($.inArray(y + '-' +(m+1) + '-' + d,dateArray) != -1) {
			return [false];
		}
	}
	return [true];
}

  </script>
</body>

</html>
