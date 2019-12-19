<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta  charset=UTF-8>
  <meta name="viewpoint" user-scalable=no>
  <title>My家計簿</title>
  <link href="style.css" rel="stylesheet">
  <script type="text/javascript">
  function addsuccess(){
    alert('新しい記録が家計簿に追加されました。');
  }
  </script>
</head>

<body>
  <header>
    <?php require_once 'header.php' ?>
  </header>
  <main>
    <div class="addjudger">
      <?php
      if(isset($_POST["addjudge"])){
        $title = "'".$_POST['title']."'";
        $price = $_POST['price'];
        $action_type = $_POST['action_type'];
        $registered_at = "'".$_POST['year']."-".$_POST['month']."-".$_POST['day']."'";
        $created_at = "'".date("Y-m-d H:i:s")."'";
        $updated_at = "'".date("Y-m-d H:i:s")."'";
        if($_POST["addjudge"] == 1){
          $mysqli = new mysqli('localhost', 'kuragane', 'VVmmjcU6TYTKJLQJ', 'Account_book');
          if($mysqli->connect_error){
            echo $mysqli->connect_error;
          }
          else{
            $mysqli->set_charset("utf-8");
            $sql = "INSERT INTO data (title, price, action_type, registered_at, created_at, updated_at) VALUES ($title, $price, $action_type, $registered_at, $created_at, $updated_at)";
            $mysqli->query($sql);
            /*
            プリペアードステートメント処理
            $stmt = $mysqli->prepare("INSERT INTO data (title, price, action_type, registered_at, created_at, updated_at) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param('siisss', $title, $price, $action_type, $registered_at, $created_at, $updated_at);
            $stmt->execute();
            $stmt->close();
            */
          }
          $mysqli->close();
          /*
          環境変数を用いたDB手続き
          require_once __DIR__.'/vendor/autoload.php';//環境変数から値を取得
          $dotenv = Dotenv\Dotenv::create(__DIR__);
          $dotenv->load();
          $mysqli = new mysqli( getenv('MYSQLHOSTNAME'), getenv('MYSQLUSERNAME'), getenv('MYSQLPASSWORD'), getenv('MYSQLDBNAME'));
          if($mysqli->connect_error){
          echo $mysqli->connect_error;
          exit();
          */
          echo "<script>";
          echo "addsuccess();";
          echo "</script>";
        }
        else if($_POST['addjudge'] == 2){
          $id = $_POST['id'];
          $mysqli = new mysqli('localhost', 'kuragane', 'VVmmjcU6TYTKJLQJ', 'Account_book');
          if($mysqli->connect_error){
            echo $mysqli->connect_error;
          }
          else{
            $mysqli->set_charset("utf-8");
            $sql = "UPDATE data SET title = $title, price = $price, action_type = $action_type, registered_at = $registered_at, updated_at = $updated_at WHERE id = $id";
            echo '<script>';
            echo 'console.log("発行されているSQL文:'. $sql .'");';
            echo '</script>';
            $mysqli->query($sql);
          }
          $mysqli->close();
        }
      }
      ?>
    </div>
    <h2>あなたの家計簿</h2>
    <div class="homeinfo">
      <?php
      //DB手続きして今月の集計を取得、出力
      $mysqli = new mysqli('localhost', 'kuragane', 'VVmmjcU6TYTKJLQJ', 'Account_book');
      if($mysqli->connect_error){
        echo $mysqli->connect_error;
      }
      else{
        $mysqli->set_charset("utf-8");
        $thisyear = date('Y');
        $thismonth = date('n');
        $sql = "SELECT * FROM data WHERE registered_at BETWEEN '".$thisyear."-".$thismonth."-1' AND '".$thisyear."-".$thismonth."-31'";
        echo '<script>';
        echo 'console.log("発行されているSQL文:'. $sql .'");';
        echo '</script>';
        if($res = $mysqli->query($sql)){
          $outcome = 0;
          $income = 0;
          while($row = $res->fetch_assoc()){
            if($row['action_type'] == 1){
              $outcome += $row['price'];
            }
            else if($row['action_type'] == 2){
              $income += $row['price'];
            }
          }
        }
      }
      echo "<p>".$thismonth."月の総支出は...".$outcome."円です。</p><hr width='35%'>";
      echo "<p>".$thismonth."月の総収入は...".$income."円です。</p><hr width='35%'>";
      $mysqli->close();
      ?>
    </div>
    <div class="homebuttons">
      <button type="button" class="mainbutton" onclick="location.href='add.php'">家計簿を新規入力</button>
      <button type="button" class="mainbutton" onclick="location.href='history.php'">家計簿を見る</button>
    </div>
  </main>
</body>

</html>
