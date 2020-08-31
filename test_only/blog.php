<?php
session_start();
if($_SESSION['id']==null){
?>

<center><br><br><br>
  <form name="login_form" action="login_check.php" method="post">
    ID :<input type="text" name="id"><br>
    PW :<input type="password" name="password"><br><br>
    <input type="submit" name="login" value="Login">
  </form>
</center>

<?php
}else{
  echo "<center><br /><br /><br />";
  echo $_SESSION[id]."님이 로그인하였습니다.";
  echo "&nbsp;<a href='logout.php'><input type='button' value='Logout'></a>";
  echo "</center>";
}
?>
