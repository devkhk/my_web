<?php

$name = $_POST['name'];
$email = $_POST['email'];
$contant = $_POST['message'];

// echo $name."\n";
// echo $email."\n";
// echo $contant."\n";


$to = "kimkhgg@daum.net";

$subject = "포트폴리오 사이트에서 발송한 이메일";

$header = 'From :'.$name.'<'.$email.'>';

$message = "컨텍트 페이지에서 보낸 이메일입니다.\n\n".$contant;

// echo "to : ".$to."\n";
// echo "header : ".$header."\n";
// echo "message : ".$message."\n";

mail($to,$subject,$message, $header);

 ?>
<script>
window.location.href="../contect.php";

</script>
