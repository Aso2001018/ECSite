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
  <div class="box">
    お名前
    <input type="text"id="name"value="テストユーザー">
  </div>
  <div class="box">
    電話番号
    <input type="text"id="tel"value="0123456789">
  </div>
  <div class="box">
    メールアドレス
    <input type="text"id="mail"value="sample@gmail.com">
  </div>
  <div class="box">
    パスワード
    <input type="text"id="pass"value="rdpassword">
  </div>
  <button>登録</button>
</div>
<?php require 'footer.php'?>