<?php require 'getDBSql.php'?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CheckDBSql</title>
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
<body>
<form method="post" action="checkDBSql.php">
<input type="text" name="input_sql" style="width:80%;">
<button type="submit">check</button>
</form>
<?php

function drawTableData($_pdo, $_sql) {
  $ary = getDBSql($_pdo, $_sql);
  if (count($ary) > 0) {
    $keys = array_keys($ary[0]);
    if (count($keys) > 0) {
      foreach ($keys as $name) {
        if (!is_numeric($name)) {
          echo '<div class="box1">', $name, '</div>';
          foreach ($ary as $value) {
            echo '<div class="box2">', $value[$name], '</div>';
          }
          echo '<br>';
        }
      }
    }
  }
}

if (isset($_POST['input_sql'])) {
  $pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
  echo '<script>console.log(\'',$_POST['input_sql'],'\');</script>';
  drawTableData($pdo,$_POST['input_sql']);
}
else {
  echo '<script>console.log(\'undefined!\');</script>';
}

?>
</body>
</html>