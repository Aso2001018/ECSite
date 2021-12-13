<?php
session_start();
require 'getDBSql.php';
if ($_POST['base'] == 'fav') {
  $ary=getDBSql('SELECT * FROM d_fav WHERE user = '.$_SESSION['user_id'].' AND item = '.$_POST['code'].';');
  $pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
  $sql=$pdo->prepare(count($ary) == 0?'INSERT INTO d_fav(user,item) VALUES(?,?);':'DELETE FROM d_fav WHERE user = ? AND item = ?;');
  $sql->execute([$_SESSION['user_id'],$_POST['code']]);
  $pdo=null;
}
else if ($_POST['base'] == 'cart') {
  if ($_POST['mode'] == 'add') {
    $ary=getDBSql('SELECT 
    d_item.OS AS OS, 
    d_item.CPU AS CPU, 
    d_item.RAM AS RAM, 
    d_item.GPU AS GPU, 
    d_item.SSD AS SSD, 
    d_item.HDD AS HDD 
    FROM d_item, m_os, m_cpu, m_ram, m_gpu, m_ssd, m_hdd 
    WHERE d_item.OS = m_os.id 
    AND d_item.CPU = m_cpu.id 
    AND d_item.RAM = m_ram.id 
    AND d_item.GPU = m_gpu.id 
    AND d_item.SSD = m_ssd.id 
    AND d_item.HDD = m_hdd.id 
    AND d_item.id = '.$_POST['code']);
    $pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
    $sql=$pdo->prepare('INSERT INTO d_cart(user,item,OS,CPU,RAM,GPU,SSD,HDD) VALUES(?,?,?,?,?,?,?,?);');
    $sql->execute([$_SESSION['user_id'],$_POST['code'],$ary[0]['OS'],$ary[0]['CPU'],$ary[0]['RAM'],$ary[0]['GPU'],$ary[0]['SSD'],$ary[0]['HDD']]);
    $pdo=null;
  }
  else if ($_POST['mode'] == 'delete') {
    getDBSql('DELETE FROM d_cart WHERE id = '.$_POST['code']);
  }
}
else if ($_POST['base'] == 'excart') {
  $pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
  $sql=$pdo->prepare('INSERT INTO d_cart(user,item,OS,CPU,RAM,GPU,SSD,HDD) VALUES(?,?,?,?,?,?,?,?)');
  $sql->execute([$_SESSION['user_id'],$_POST['code'],$_POST['os'],$_POST['cpu'],$_POST['ram'],$_POST['gpu'],$_POST['ssd'],$_POST['hdd']]);
  $pdo=null;
}
?>