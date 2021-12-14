<?php require 'header.php'?>
<h2>ログイン</h2>
<?php
if (!empty($_SESSION['msg'])) {
  echo '<div class="alert">',$_SESSION['msg'],'</div>';
  $_SESSION['msg'] = '';
}
?>
<div class="loginfield">
  <form method="post"action="connect-php/login-connect.php">
    <div class="box">
      メールアドレス
      <input type="text"name="mail"value="sample@gmail.com">
    </div>
    <div class="box">
      パスワード
      <input type="text"name="pass"value="password">
    </div>
    <button type="submit">ログイン</button>
  </form>
</div>
<?php require 'footer.php'?>