<?php
include 'whois.php';

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>관리자 페이지</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['visitor', 'count'],
          ['Interested in', <?php echo $count[md5("interested")]; ?>], //알아보기 쉽게 인덱스배열이 아닌 연관배열로 했다.
          ['Stranger',      <?php echo $count[md5("stranger")]; ?>],
          ['Wayfarer',      <?php echo $count[md5("wayfarer")]; ?>]
        ]);

        var options = {
          title: '방문자 현황',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

  </head>
  <body>
    <!-- 방문객현황 -->
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
