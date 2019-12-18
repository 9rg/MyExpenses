<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta  charset=UTF-8>
  <meta name="viewpoint" user-scalable=no>
  <title>My家計簿</title>
  <link href="style.css" rel="stylesheet">
</head>

<body>
  <header>
    <?php require_once 'header.php' ?>
  </header>
  <main>
    <div class="addjudger">
      <?php
      if(isset($_POST["addjudge"])){
        if($_POST["addjudge"] == 1){
          $title = "'".$_POST['title']."'";
          $price = $_POST['price'];
          $action_type = $_POST['action_type'];
          $registered_at = "'".$_POST['year']."-".$_POST['month']."-".$_POST['day']."'";
          $created_at = "'".date("Y-m-d H:i:s")."'";
          $updated_at = "'".date("Y-m-d H:i:s")."'";
          $mysqli = new mysqli('localhost', 'kuragane', 'VVmmjcU6TYTKJLQJ', 'Account_book');
          if($mysqli->connect_error){
            echo $mysqli->connect_error;
          }
          else{
            $mysqli->set_charset("utf-8");
            $sql = "INSERT INTO data (title, price, action_type, registered_at, created_at, updated_at) VALUES ($title, $price, $action_type, $registered_at, $created_at, $updated_at)";
            echo '<script>';
            echo 'console.log("発行されているSQL文:'. $sql .'");';
            echo '</script>';
            $mysqli->query($sql);
          }
          $mysqli->close();
          /*  環境変数を用いたDB手続き
          require_once __DIR__.'/vendor/autoload.php';//環境変数から値を取得
          $dotenv = Dotenv\Dotenv::create(__DIR__);
          $dotenv->load();
          $mysqli = new mysqli( getenv('MYSQLHOSTNAME'), getenv('MYSQLUSERNAME'), getenv('MYSQLPASSWORD'), getenv('MYSQLDBNAME'));
          if($mysqli->connect_error){
          echo $mysqli->connect_error;
          exit();
        }
        else{
        $mysqli->set_charset("utf-8");
      }
      プリペアードステートメント処理    ←DBうまく連携できたら
      $stmt = $mysqli->prepare("INSERT INTO money (title, price, action_type, registered_at, created_at, updated_at) VALUES (?,?,?,?,?,?)");//SQL文を作成
      $stmt->bind_param('siisss', $title, $price, $action_type, $registered_at, $created_at, $updated_at);//変数をバインド(代入っぽい感じ)
      $stmt->execute();//SQL文の実行
      $stmt->close();//stmtクラスを閉じる
      $mysqli->close();//データベースとの接続を閉じる
      */

      echo "家計簿にデータを追加しました";//javascriptで実装！
    }
  }
  ?>
</div>
<h2>あなたの家計簿</h2>
<div class="homeinfo">
  <?php
  //DB手続きして今月の集計を取得、出力
  ?>
</div>
<div class="homebuttons">
  <button type="button" onclick="location.href='add.php'">家計簿を新規入力</button>
  <button type="button" onclick="location.href='history.php'">家計簿を見る</button>
</div>
</main>
</body>

</html>
