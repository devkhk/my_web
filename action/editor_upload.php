<?php
if(empty($_FILES['file']))
{
	exit();
}
$datetime = date("Ymd");
$temp = explode(".", $_FILES["file"]["name"]);
$newfilename = $datetime.sprintf('%06d',rand(000000,999999)).'.'. end($temp);
$destinationFilePath = '../blog/img-upload/'.$newfilename ;
if(!move_uploaded_file($_FILES['file']['tmp_name'], $destinationFilePath)){
	echo $errorImgFile;
}
else{
	echo $destinationFilePath;
}

?>
