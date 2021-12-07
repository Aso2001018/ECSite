<?php require 'header.php'?>
<h2>会員情報</h2>
<div class="info">
  <div class="add_top">名前</div>
  <div class="add_dat"><?=$_SESSION['name']?></div>
  <div class="add_top">メールアドレス</div>
  <div class="add_dat"><?=$_SESSION['mail']?></div>
  <div class="add_top">電話</div>
  <div class="add_dat"><?=$_SESSION['tel']?></div>
  <div class="add_top">パスワード</div>
  <div class="add_dat"><?=$_SESSION['pass']?></div>
</div>
<?php require 'footer.php'?>