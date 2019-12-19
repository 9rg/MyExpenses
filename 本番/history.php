<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta  charset=UTF-8>
  <meta name="viewpoint" user-scalable=no>
  <title>My家計簿</title>
  <link href="style.css" rel="stylesheet">
  <script>
  function check(){
    var result = window.confirm('本当にこの記録を削除しますか？');
    if(result){
      return true;
    }
    else{
      return false;
    }
  }
  </script>
</head>

<body>
  <header>
    <?php require_once 'header.php' ?>
  </header>
  <main>
    <div class="deletejudger">
      <?php
      if(isset($_POST['deletejudge'])){
        if($_POST['deletejudge'] == 1){
          require_once __DIR__.'/vendor/autoload.php';//環境変数から値を取得
          $dotenv = Dotenv\Dotenv::create(__DIR__);
          $dotenv->load();
          $mysqli = new mysqli( getenv('MYSQLHOSTNAME'), getenv('MYSQLUSERNAME'), getenv('MYSQLPASSWORD'), getenv('MYSQLDBNAME'));
          if($mysqli->connect_error){
            echo $mysqli->connect_error;
          }
          else{
            $mysqli->set_charset("utf-8");
            $id = $_POST['id'];
            $sql = "DELETE FROM data WHERE id = $id";
            $mysqli->query($sql);
          }
          $mysqli->close();
          echo "<script>";
          echo "alert('データが正常に削除されました。');";
          echo "</script>";
        }
      }
      ?>
    </div>
    <div class="monthDisplayer">
      <!-- ボタン1 -->
      <?php
      echo "<h2>家計簿</h2>";
      /*
      $month = date('n');
      echo $month."月の家計簿";
      */
      ?>
      <!-- ボタン2 -->
    </div>
    <div class="listwrapper">
      <?php
      require_once __DIR__.'/vendor/autoload.php';//環境変数から値を取得
      $dotenv = Dotenv\Dotenv::create(__DIR__);
      $dotenv->load();
      $mysqli = new mysqli( getenv('MYSQLHOSTNAME'), getenv('MYSQLUSERNAME'), getenv('MYSQLPASSWORD'), getenv('MYSQLDBNAME'));
      if($mysqli->connect_error){
        echo $mysqli->connect_error;
      }
      else{
        $mysqli->set_charset("utf-8");
        $sql = "SELECT * FROM data ORDER BY registered_at ASC";
        if($res = $mysqli->query($sql)){
          require "classforlist.php";
          while($row = $res->fetch_assoc()){
            $data = new Historydata($row['id'], $row['registered_at'], $row['action_type'], $row['price'], $row['title']);
            $data->show();
            echo "<input type='submit' value='削除' name='submit' class='subbutton' onclick='return check()'></form>";
            echo "</div></div><br>";
            echo "<hr>";
          }
        }
      }
      $mysqli->close();
      ?>
    </div>
  </main>
</body>
</html>
