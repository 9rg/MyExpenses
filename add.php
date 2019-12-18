<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta  charset=UTF-8>
  <meta name="viewpoint" user-scalable=no>
  <title>My家計簿</title>
  <link href="style.css" rel="stylesheet">
  <script type="text/javascript">
  function check(){
    //1つでも入力されていなかったらfalse
  }
  </script>
</head>

<body>
  <header>
    <?php require_once 'header.php' ?>
  </header>
  <main>
    <h2>新規支出・収入入力</h2>
    <div class="formbox">
      <form method="post" action="index.php" name="form1">
        <p>
          <label for="year">日時</label>
          <select name="year">
            <?php
            for($i=2014;$i<2021;$i++){
              echo "<option value='".$i."'>".$i."</option>";
            }
            ?>
          </select>
          <label for="month"></label>
          <select name="month">
            <?php
            for($i=1;$i<13;$i++){
              echo "<option value='".$i."'>".$i."</option>";
            } ?>
          </select>
          <label for="day"></label>
          <select name="day">
            <?php
            for($i=1;$i<32;$i++){
              echo "<option value='".$i."'>".$i."</option>";
            } ?>
          </select>
        </p>
        <p>
          <label for="title">タイトル</label>
          <input type="text" name="title" class="title" value="">
        </p>
        <p>
          <label for="price">金額</label>
          <input type="number" name="price" class="price" value="">
        </p>
        <p>
          支出<input type="radio" name="action_type" value="1">
          収入<input type="radio" name="action_type" value="2">
        </p>
        <input type="hidden" name="addjudge" value=1>
        <input type="submit" name="submit" value="家計簿に追加" class="submit" onclick="return check()">
      </form>
    </div>
  </main>
</body>
</html>
