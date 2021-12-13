<?php
session_start();
require 'getDBSql.php';
if (isset($_SESSION['login'])) {
  if (isset($_POST['mail'])&&isset($_POST['pass'])) {
    $ret = getDbSql('SELECT * FROM m_customers WHERE mail = "'.$_POST['mail'].'" AND password = "'.$_POST['pass'].'";');
    if(count($ret) == 1) {
      $_SESSION['login'] = true;
      $_SESSION['user_id'] = $ret[0]['id'];
      $_SESSION['name'] = $ret[0]['name'];
      $_SESSION['tel'] = $ret[0]['tel'];
      $_SESSION['pass'] = $ret[0]['password'];
      $_SESSION['mail'] = $ret[0]['mail'];
      http_response_code(301);
      header("Location: ../index.php");
      endDbSql();
      exit;
    }
    else {
      $_SESSION['msg'] = '一致するアカウントが見つかりませんでした。';
      http_response_code(301);
      header("Location: ../login.php");
      endDbSql();
      exit;
    }
  }
  else {
    if(isset($_POST['msg']))
      $_SESSION['msg'] = $_POST['msg'];
    else
      $_SESSION['msg'] = '一致するアカウントが見つかりませんでした。';
    http_response_code(301);
    header("Location: ../login.php");
    endDbSql();
    exit;
  }
}
else {
	http_response_code(301);
	header("Location: ../login.php");
  endDbSql();
	exit;
}
?>