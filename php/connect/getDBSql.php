<?php
function getDbSql($sql){
  $pdo = new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
  $ary=array();
  foreach ($pdo->query($sql) as $val) {
    array_push($ary, $val);
  }
  $pdo=null;
  return$ary;
}
?>