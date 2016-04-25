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
      echo "<form action='signup.php' method='post'>";
      echo "<label><span>用户名</span><input type='text' name='username'/></label>";
      echo "<br/>";
      echo "<label><span>E-mail</span><input type='text' name='email'/></label>";
      echo "<br/>";
      echo "<label><span>密码</span><input type='password' name='passwd'/></label>";
      echo "<br/>";
      echo "<label><span>确认密码</span><input type='password' name='passwd-confirm'/></label>";
      echo "<input type='submit' value='提交'/>";
      echo "</form>";
    }

    if(isset($_SESSION['id'])){
      require_once('list.php');
    } else {
        if (isset($_POST['username'])&&(isset($_POST['passwd'])) && (isset($_POST['passwd-confirm'])) && (isset($_POST['email']))){
          if($_POST['passwd'] == $_POST['passwd-confirm']){
          $db = new mysqli('localhost','root','root','list');
          if ($db->connect_errno) {
            echo "problem";
            exit();
            } else {
            $db->set_charset('utf8');
            $username = $_POST['username'];
            $passwd = $_POST['passwd'];
            $email = $_POST['email'];
            $query = "insert into users values(NULL,'".$username."','".$email."','".sha1($passwd)."')";
            $result = $db->query($query);
            if($result){
              $_SESSION['id'] = $db->insert_id;
              require_once('list.php');
            } else {
              echo "注册失败";
            }
            $db->close();
            }
          } else {
          echo "请确认您的密码";
          display();

         }
      }else {
        display();
          echo "<a href='index.php'>已有账号，直接登陆 </a>";
      }
    }

?>

</html>
