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
    var flag = 0;
    if(document.form1.title.value == ""){
      flag += 1;
    }
    if(document.form1.price.value == ""){
      flag += 1;
    }
    if(document.form1.action_type.value == ""){
      flag+= 1;
    }
    if(flag == 0){
      return true;
    }
    else{
      alert('入力されていない箇所があります。');
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
    <h2>新規支出・収入入力</h2>
    <div class="formbox">
      <form method="post" action="index.php" name="form1">
        <?php
        $year = date('Y');
        $month = date('n');
        $day = date('j');
         ?>
        <p>
          <label for="year">日時</label>
          <select name="year">
            <?php
            for($i=2014;$i<2021;$i++){
              if($i == $year){
                echo "<option value='$i' selected>".$i."</option>";
              }
              else{
                echo "<option value='$i'>".$i."</option>";
              }
            }
            ?>
          </select>
          <label for="month"></label>
          <select name="month">
            <?php
            for($i=1;$i<13;$i++){
              if($i == $month){
                echo "<option value='$i' selected>".$i."</option>";
              }
              else{
                echo "<option value='$i'>".$i."</option>";
              }
            } ?>
          </select>
          <label for="day"></label>
          <select name="day">
            <?php
            for($i=1;$i<32;$i++){
              if($i == $day){
                echo "<option value='$i' selected>".$i."</option>";
              }
              else{
                echo "<option value='$i'>".$i."</option>";
              }
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
          支出<input type="radio" name="action_type" class="action_type" value="1">
          収入<input type="radio" name="action_type" class="action_type" value="2">
        </p>
        <input type="hidden" name="addjudge" value=1>
        <input type="submit" name="submit" value="家計簿に追加" class="mainbutton" onclick="return check()">
      </form>
    </div>
  </main>
</body>
</html>
