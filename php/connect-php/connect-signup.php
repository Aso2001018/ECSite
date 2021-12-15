<?php
$_POST['name'];
$_POST['tel'];
$_POST['mail'];
$_POST['pass'];
$pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
$sql=$pdo->prepare('INSERT INTO m_user(password,name,tel,mail) VALUES(?,?,?,?)');
$sql->bindValue(1,$_POST['pass'],PDO::PARAM_STR);
$sql->bindValue(2,$_POST['name'],PDO::PARAM_STR);
$sql->bindValue(3,$_POST['tel'],PDO::PARAM_STR);
$sql->bindValue(4,$_POST['mail'],PDO::PARAM_STR);
date("Y-m-d H:i:s");
$sql->execute();
$pdo=null;
http_response_code(301);
header("Location: ../index.php");
exit;
?>