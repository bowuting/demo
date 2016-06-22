<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" style="text/css" href='style.css'/>
    <title>to-do-list</title>
  </head>
    <?php
    session_start();
    if(isset($_SESSION['id'])){
      session_destroy();
      echo "你已经退出了";

    } else  {
      echo "你还没有登陆";
    }
    echo "<br/>";
    echo "<a href='index.php'>你想登陆吗？</a>";
    ?>
</html>
