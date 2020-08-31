<?php

 $host = 'localhost';
 $user = 'root';
 $pw = 'tpsxhtm23';
 $dbName = 'admin';

 $dbConnect = new mysqli($host,$user,$pw,$dbName);
 $dbConnect -> set_charset("utf8");

if($dbConnect->connect_errno){
  die('Connection Error:'.$dbConnect->connect_error);
}

?>
