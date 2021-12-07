<?php
function getDbSql($_pdo, $_sql){
  $_ary=array();
  foreach ($_pdo->query($_sql) as $_val) {
    array_push($_ary, $_val);
  }
  return$_ary;
}
?>