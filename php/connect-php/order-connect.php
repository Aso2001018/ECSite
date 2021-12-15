<?php
session_start();
require 'getDBSql.php';
$ary=getDbSql('SELECT 
d_cart.id AS id, 
d_item.price + m_os.price + m_cpu.price + m_ram.price + m_gpu.price + m_ssd.price + m_hdd.price AS Price 
FROM d_cart, d_item, m_os, m_cpu, m_ram, m_gpu, m_ssd, m_hdd 
WHERE d_cart.OS = m_os.id 
AND d_cart.CPU = m_cpu.id 
AND d_cart.RAM = m_ram.id 
AND d_cart.GPU = m_gpu.id 
AND d_cart.SSD = m_ssd.id 
AND d_cart.HDD = m_hdd.id 
AND d_cart.item = d_item.id 
AND d_cart.ordered = 0 
AND d_cart.user = '.$_SESSION['user_id']);
$price = 0;
foreach($ary as $item) {
  $price+=$item['Price'];
}
$pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
$sql=$pdo->prepare('INSERT INTO d_order(user,order_date,price) VALUES('.$_SESSION['user_id'].',"'.date('Y-m-d').'",'.$price.');');
$sql->execute();
$ida=getDbSql('SELECT id FROM d_order WHERE user = '.$_SESSION['user_id'].';');
$id=$ida[count($ida)-1]['id'];
$_SESSION['order_id'] = $id;
foreach($ary as $item) {
  $sql=$pdo->prepare('INSERT INTO d_order_detail(orderid,cart) VALUES('.$id.','.$item['id'].');');
  $sql->execute();
}
$sql=$pdo->prepare('UPDATE d_cart SET ordered = 1 WHERE user = '.$_SESSION['user_id']);
$sql->execute();
$pdo=null;
http_response_code(301);
header("Location: ../ordered.php");
exit;
?>