<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" style="text/css" href='style.css'/>
    <title>to-do-list</title>
  </head>

<?php
  @session_start();

    $current_userid = $_SESSION['id'];

    $query = "select id,title,description,complete_by,complete_on from items where user_id = $current_userid";
    $db = new mysqli('localhost','root','root','list');
    $db->set_charset('utf8');
    if ($db->connect_errno) {
      echo "problem";
      exit();
    }else {

        if(isset($_POST['completed-item'])){
          $item_id = $_POST['completed-item'];
          $completed_quey = "update items set complete_on = '".date("Y-m-d")."' where id= $item_id";
          $completed_result = $db->query($completed_quey);
          if(!$completed_result){
            echo "没有更新";
            exit();
          }
        }

        if (isset($_POST['title'])) {
          $title = $_POST['title'];
          $description = $_POST['description'];
          $complete_by = $_POST['complete_by'];
          $user_id = $_SESSION['id'];
          $stmt = $db->prepare("insert into items values(?,?,?,?,?,?)");
          $id = NULL;
          $complete_on = NULL;
          $stmt->bind_param("issssi",$id,$title,$description,$complete_by,$complete_on,$user_id);
          $stmt->execute();
          if (!$stmt->affected_rows) {
            echo "没有插入";
          }
          //  $insert_query = "insert into items values (NULL,'".$title."','".$description."','".$complete_by."',NULL,'".  $user_id ."')";
          //  $insert_result = $db->query($insert_query);
          //if(!$insert_result){
        //    echo "没有插入";
          //  exit();
        //  }
        }

        if(isset($_POST['item-to-delete'])){
          $item_to_delete = $_POST['item-to-delete'];
          $delete_query = "delete from items where id = $item_to_delete";
          $delete_result = $db->query($delete_query);
          if(!$delete_result){
            echo "没有删除";
            exit();
          }
        }

        $result = $db->query($query);
        if ($result->num_rows) {
          echo "<table>";
          echo "<caption>我的To-Do List!</caption>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>号</th>";
          $result->field_seek(1);

          while($field = $result->fetch_field()){
              echo "<th>".$field->name."</th>";//输出列名
              }
          echo "<th>删除</th>";
          echo "</tr>";
          echo "</thead>";
          for ($i=1; $row = $result->fetch_assoc();  $i++) {
          //if($i == 2)  print_r($row);
            echo "<tr>";
            echo "<td> $i </td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['description']."</td>";
            echo "<td>";
           if(!$row['complete_by']){
             echo "无最后期限";
            }else{
             echo $row['complete_by'];
           }
           echo "</td>";
            if(!$row['complete_on']){
                echo "<td>";
                echo "<form actiot='list.php' method='post'>";
                echo "<input type='hidden' value='".$row['id']."' name='completed-item' />";
                echo "<input type='submit' value='标记为完成'/>";
                echo "</form>";
                echo "</td>";
            }else{
                echo "<td>".$row['complete_on']."</td>";
            }

            echo "<td>";
              echo "<form action='list.php' method='post'>";
              echo "<input type='hidden' name = 'item-to-delete' value='".$row['id']."'/>";
              echo "<input type='submit' value='删除'>";
              echo "</form>";
            echo "</td>";

            echo "</tr>";
          }



      }
      echo "</table>";
      echo "<form action='list.php' method='post'>";
      echo "<h1>创建新事项</h1>";
      echo "<label><span>题目</span><input type='text' name='title'></label>";
      echo "<label><span>最后期限</span><input type='text' name='complete_by' value='YYYY-MM-DD'></label>";
      echo "<label><span>描写</span><textarea name='description'></textarea></label>";
      echo "<input type='submit' value='创建新事项'>";
    }



    echo "<a href='signout.php'>退出</a>";
  
?>
</html>
