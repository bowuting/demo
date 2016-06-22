<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" style="text/css" href='style.css'/>
    <title>to-do-list</title>
  </head>

<?php

  session_start();
  function display()
  {
    echo "<form action='index.php' method='post'>";
    echo "<h2>欢迎你登陆<h2>";
    echo "<label><span>用户名</span><input type='text' name='username'/></label>";
    echo "<label><span>密码</span><input type='password' name='passwd'/></label>";
    echo "<input type='submit' value='登录'/>";
    echo "</form>";
    echo "<a href='signup.php'>如果你还不是会员 点击此处注册</a>";
  }

  if((isset($_POST['username']))&&(isset($_POST['passwd']))) {
    $db = new mysqli('localhost','root','root','list');
    $db->set_charset('utf8');
    if ($db->connect_errno) {
      echo "problem";
    }else {

      $username = $_POST['username'];
      $passwd   = $_POST['passwd'];

      $query = "select id,username from users where username='".$username."' and passwd='".sha1($passwd)."'";
      //echo $query;
      $result = $db->query($query);
      if($result->num_rows){
        echo "欢迎";

        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $result->free();

      }else {
        echo "用户名或密码错误";
      }
      $db->close();
    }
  }
  if(isset($_SESSION['id'])){
    require_once('list.php');
  } else {
    display();
  }

?>

</html>
