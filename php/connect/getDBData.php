<?php require 'getDBSql.php'?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>DataBase</title>
<style>
.box1{
  width:60px;
  display:inline-block;
  border:1px;
  border-style:solid;
  border-color:#000;
  background-color:#CCC;
}
.box2{
  width:150px;
  max-width:150px;
  display:inline-block;
  border:1px;
  border-style:solid;
  border-color:#000;
  background-color:#FFF;
}
</style>
</head>
</body>

<?php

function drawTableData($_pdo,$_table) {
  echo'<h3>',$_table,'</h3>';
  $ary=getDBSql($_pdo,'SELECT * FROM '.$_table);
  if (count($ary)>0) {
    $keys=array_keys($ary[0]);
    foreach ($keys as $name) {
      if (!is_numeric($name)) {
        echo '<div class="box1">',$name,'</div>';
        foreach ($ary as $value) {
          echo '<div class="box2">',$value[$name],'</div>';
        }
        echo '<br>';
      }
    }
  }
}
function drawTableDB($_pdo) {
  echo'<h2>table list</h2>';
  $ary=getDBSql($_pdo,'show tables');
  $keys=array_keys($ary);
  $list=[];
  foreach($ary as $table) {
    array_push($list,$table['Tables_in_LAA1290643-sd2a03dev']);
    echo'<div class="box2">',$table['Tables_in_LAA1290643-sd2a03dev'],'</div><br>';
  }
  return $list;
}

$pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
$tablelist = drawTableDB($pdo);
foreach($tablelist as $table) {
  drawTableData($pdo,$table);
}

?>
</body>
</html>