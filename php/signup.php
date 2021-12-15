<?php require 'header.php'?>
<?php
if ($_SESSION['login']) {
	http_response_code(301);
	header("Location: ./index.php");
	exit;
}
if (!empty($_SESSION['signup-msg'])) {
  echo '<div class="alert">',$_SESSION['signup-msg'],'</div>';
  $_SESSION['signup-msg']='';
}
?>
<h2>新規会員登録</h2>
<div class="signupfield">
  <form method="post"action="connect-php/signup-connect.php">
    <div class="box">
      メールアドレス
      <input type="email"name="mail"id="mail"value="sample@gmail.com"pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
    </div>
    <div class="box">
      パスワード
      <input type="password"name="pass"id="pass"value="rdpassword">
    </div>
    <div class="box">
      お名前
      <input type="text"name="name"id="name"value="テストユーザー">
    </div>
    <div class="box">
      電話番号
      <input type="tel"name="tel"id="tel"value="0123456789"pattern=".\d{9,12}">
    </div>
    <div class="box">
      住所
      <input type="text"name="addr"id="addr"value="abcx">
    </div>
    <div class="box">
      郵便番号
      <input type="number"name="addn"id="addn"value="0123456"pattern=".\d{7}">
    </div>
    <button type="submit">登録</button>
  </form>
</div>
<?php require 'footer.php'?>