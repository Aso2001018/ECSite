<?php
require 'header.php';
if(isset($_POST['change'])) {
  $ary=getDbSql('SELECT * FROM m_user WHERE id = '.$_SESSION['user_id']);
  if ($ary[0]['password']==$_POST['password']) {
    $pdo = new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
    $sql=$pdo->prepare('UPDATE m_user SET name = ?, tel = ?, address = ?, address_number = ? WHERE id = ?;');
    $sql->execute([
      $_POST['name'],
      $_POST['tel'],
      $_POST['address'],
      $_POST['address_number'],
      $_SESSION['user_id']
    ]);
    $pdo = null;
    echo'<div class="message">情報が変更されました。</div>';
  }
  else {
    echo'<div class="alert">パスワードが間違っています。</div>';
  }
}

$ary = getDbSql('SELECT * FROM m_user WHERE id = '.$_SESSION['user_id'].';');
?>
<h2>会員情報</h2>
<form method="post"action="info.php">
  <div class="info">
    <div class="add_top">名前</div>
    <div class="add_dat"><input type="text"name="name"value="<?=$ary[0]['name']?>"></div>
    <div class="add_top">電話</div>
    <div class="add_dat"><input type="tel"name="tel"value="<?=$ary[0]['tel']?>"></div>
    <div class="add_top">住所</div>
    <div class="add_dat"><input type="text"name="address"value="<?=$ary[0]['address']?>"></div>
    <div class="add_top">郵便番号</div>
    <div class="add_dat"><input type="number"name="address_number"maxlength="7"pattern=".{7,7}"value="<?=$ary[0]['address_number']?>"></div>
    <div class="add_top">登録日</div>
    <div class="add_dat"><?=$ary[0]['reg_date']?></div>
    <div class="add_top">メールアドレス</div>
    <div class="add_dat"><?=$ary[0]['mail']?></div>
    <div class="add_top">パスワード</div>
    <div class="add_dat"><input type="password"name="password"value="<?=$ary[0]['password']?>"></div>
  </div>
  <div class="button_area">
    <button type="button"onclick="location.href='history.php'">購入履歴</button>
    <button type="submit"name="change"value="change"onclick="location.href='info.php'">会員情報を変更する</button>
  </div>
</form>
<?php require 'footer.php'?>