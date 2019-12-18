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
    <div class="monthDisplayer">
      <!-- ボタン1 -->
      <?php
      $month = date('m');
      echo $month."月の家計簿";
      ?>
      <!-- ボタン2 -->
    </div>
    <div class="listwrapper">
      <?php
      $mysqli = new mysqli('localhost', 'kuragane', 'VVmmjcU6TYTKJLQJ', 'Account_book');
      if($mysqli->connect_error){
        echo $mysqli->connect_error;
      }
      else{
        $mysqli->set_charset("utf-8");
        $sql = "SELECT * FROM data";
        if($res = $mysqli->query($sql)){
          while($row = $res->fetch_assoc()){
            $orgdata = strtotime($row['registered_at']);
            $date = date('n/j', $orgdata);
            $price = $row['price'];
            $title = $row['title'];
            echo "<p>".$date." ¥".$price." ".$title."</p>";
          }
        }
      }
      $mysqli->close();
      ?>
    </div>
  </main>
</body>
</html>
