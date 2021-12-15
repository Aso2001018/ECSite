<?php
session_start();
require 'getDBSql.php';

if (empty($_POST['name'])||empty($_POST['tel'])||empty($_POST['mail'])||empty($_POST['pass'])||empty($_POST['addr'])||empty($_POST['addn'])) {
  $_SESSION['signup-msg']='入力に問題があります。';
  http_response_code(301);
  header("Location: ../signup.php");
  exit;
}
else {
  $ary=getDbSql('SELECT count(*) FROM m_user WHERE mail = \''.$_POST['mail'].'\';');
  if (count($ary) != 0) {
    $_SESSION['signup-msg']='登録されていないメールアドレスを利用してください。';
    http_response_code(301);
    header("Location: ../signup.php");
    exit;
  }
  else {
    $pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
    $sql=$pdo->prepare('INSERT 
    INTO m_user(password,name,tel,mail,reg_date,address,address_number) 
    VALUES(\''.$_POST['pass'].'\',\''.$_POST['name'].'\','.$_POST['tel'].',\''.$_POST['mail'].'\',\''.date("Y-m-d").'\',\''.$_POST['addr'].'\','.$_POST['addn'].')');
    $sql->execute();
    $pdo=null;
    $ary=getDbSql('SELECT id FROM m_user 
    WHERE password = \''.$_POST['pass'].'\' 
    AND name = \''.$_POST['name'].'\' 
    AND tel = '.$_POST['tel'].' 
    AND address = \''.$_POST['addr'].'\' 
    AND address_number = '.$_POST['addn'].'
    ');
    if(count($ary)==0) {
  
    }
    else {
      $_SESSION['login'] = true;
      $_SESSION['user_id'] = $ary[0]['id'];
    }
  }
  http_response_code(301);
  header("Location: ../index.php");
  exit;
}
?>