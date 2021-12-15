<?php
require 'header.php';
require 'connect-php/getDBSql.php';
$ary = getDbSql('SELECT * FROM m_user WHERE id = '.$_SESSION['user_id'].';');
?>
<h2>会員情報</h2>
<div class="info">
  <div class="add_top">名前</div>
  <div class="add_dat"><?=$ary[0]['name']?></div>
  <div class="add_top">メールアドレス</div>
  <div class="add_dat"><?=$ary[0]['mail']?></div>
  <div class="add_top">パスワード</div>
  <div class="add_dat"><?=$ary[0]['password']?></div>
  <div class="add_top">電話</div>
  <div class="add_dat"><?=$ary[0]['tel']?></div>
  <div class="add_top">住所</div>
  <div class="add_dat"><?=$ary[0]['address']?></div>
  <div class="add_top">郵便番号</div>
  <div class="add_dat"><?=$ary[0]['address_number']?></div>
  <div class="add_top">登録日</div>
  <div class="add_dat"><?=$ary[0]['reg_date']?></div>
</div>
<?php require 'footer.php'?>