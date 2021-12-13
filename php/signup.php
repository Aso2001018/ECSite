<?php require 'header.php'?>
<?php
if ($_SESSION['login']) {
	http_response_code(301);
	header("Location: ./index.php");
	exit;
}
?>
<h2>新規会員登録</h2>
<div class="signupfield">
  <form method="post"action="connect/connect-signup.php">
    <div class="box">
      お名前
      <input type="text"name="name"id="name"value="テストユーザー">
    </div>
    <div class="box">
      電話番号
      <input type="text"name="tel"id="tel"value="0123456789">
    </div>
    <div class="box">
      メールアドレス
      <input type="text"name="mail"id="mail"value="sample@gmail.com">
    </div>
    <div class="box">
      パスワード
      <input type="text"name="pass"id="pass"value="rdpassword">
    </div>
    <button type="submit">登録</button>
  </form>
</div>
<?php require 'footer.php'?>