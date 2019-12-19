<?php
class Historydata {
  public $id;
  public $date;
  public $action_type;
  public $price;
  public $title;
  function __construct($id, $date, $action_type, $price, $title){
    //日付データの整形
    $orgdate = strtotime($date);
    $date = date('n/j', $orgdate);
    //各パラメータをセット
    $this->id = $id;
    $this->date = $date;
    //action_typeを値に変換
    if($action_type == 1){
      $this->action_type = '-';
    }
    else if($action_type == 2){
      $this->action_type = '+';
    }
    $this->price = $price;
    $this->title = $title;
  }
  function show() {
    //出力
    echo "<div class='contents_container'>";
    echo "<div>{$this->date} {$this->action_type}¥{$this->price} {$this->title}</div>";
    echo "<div class='buttonswrapper'>";
    echo "<form action='edit.php' method='post'><input type='hidden' name='id' value='".$this->id."'><input type='hidden' name='date' value='".$this->date."'><input type='hidden' name='action_type' value='".$this->action_type."'><input type='hidden' name='price' value='".$this->price."'><input type='hidden' name='title' value='".$this->title."'><input type='submit' value='編集' name='submit'></form>";
    //以下、削除ボタンを実装
    echo "</div></div><br>";
  }
}
?>
