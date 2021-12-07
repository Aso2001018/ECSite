<?php
session_start();
require 'getDBSql.php';
if (isset($_SESSION['login'])) {
  if (isset($_POST['mail'])&&isset($_POST['pass'])) {
    $pdo = new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
    $ret = getDbSql($pdo,'SELECT * FROM m_customers WHERE mail = "'.$_POST['mail'].'" AND password = "'.$_POST['pass'].'";');
    if(count($ret) == 1) {
      $_SESSION['login'] = true;
      $_SESSION['name'] = $ret[0]['name'];
      $_SESSION['tel'] = $ret[0]['tel'];
      $_SESSION['pass'] = $ret[0]['password'];
      $_SESSION['mail'] = $ret[0]['mail'];
      http_response_code(301);
      header("Location: ../index.php");
      exit;
    }
    else {
      $_SESSION['msg'] = '一致するアカウントが見つかりませんでした。';
      http_response_code(301);
      header("Location: ../login.php");
      exit;
    }
  }
  else {
    $_SESSION['msg'] = '一致するアカウントが見つかりませんでした。';
    http_response_code(301);
    header("Location: ../login.php");
    exit;
  }
}
else {
	http_response_code(301);
	header("Location: ../login.php");
	exit;
}
?>