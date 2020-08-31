<?php

$dir = '../blog/img-upload/';

//디렉토리 패스 체크
if(!is_dir($dir)){
  echo '"'.$dir.'"is not directory. Check th directory path.';
  exit;
}else{

  //디렉토리 열기
  $dir_obj = opendir($dir);
  //디렉토리 내에 파일명을 배열에 저장.
  $files = array();

  while(($file = readdir($dir_obj)) != false){
    //리눅스에서만 보이는 .와 ..와 디렉토리를 제거한 나머지를 배열에 저장.
    if($file != '.' && $file != '..' && !is_dir($dir . $file)){
      array_push($files,$file);
    }

  }
  foreach ($files as $file) {
    $path = $dir . $file;

    $file_path_info = pathinfo($path);
    $file_name = $file_path_info['filename'];
    $file_extension = $file_path_info['extension'];

    // 업로드 된 이미지 파일 정보를 가져온다.
    $img = getimagesize($path);
    //저용량 jpg 파일 생성
    if($img['mime'] == 'image/png'){
      $image = imagecreatefrompng($path);
    }else if($img['mime'] == 'image/gif'){
      $image = imagecreatefromgif($path);
    }else if($img['mime'] == 'image/jpeg'){
      $image = imagecreatefromjpeg($path);
    }else{
      $image = null;
    }

    //파일 압축 및 업로드
    if(isset($image)){
      $thumb_path = '../blog/img-thumbnail/'.$file_name.'_thumb.jpg';
      imagejpeg($image, $thumb_path,70);
      // echo 'complete resize image: '.$thumb_path.'';

    }

  }
  closedir($dir_obj);
}
 ?>
