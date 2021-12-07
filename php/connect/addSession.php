<?php
session_start();
require 'getDBSql.php';
if ($_POST['base'] == 'fav') {
  $isset = false;
  for ($n = 1;$n <= $_SESSION['fav_num']; $n++) {
    //登録済みであれば削除
    if ($_SESSION['fav_'.$n.'_item_code'] == $_POST['code']) {
      $isset = true;
      for ($l = $n; $l < $_SESSION['fav_num']; $l++) {
        $_SESSION['fav_'.$l.'_item_code'] = (int)$_SESSION['fav_'.($l+1).'_item_code'];
      }
      unset($_SESSION['fav_'.$_SESSION['fav_num'].'_item_code']);
      $_SESSION['fav_num']--;
      break;
    }
  }
  if (!$isset) {
    $i = ++$_SESSION[$_POST['base'].'_num'];
    $_SESSION[$_POST['base'].'_'.$i.'_item_code'] = (int)$_POST['code'];  
  }
}
else if ($_POST['base'] == 'cart') {
  if ($_POST['mode'] == 'add') {
    $i = ++$_SESSION['cart_num'];
    $_SESSION['cart_'.$i.'_item_code'] = $_POST['code'];
    $_SESSION['cart_'.$i.'_cart_code'] = $i == 1 ? 1 : $_SESSION['cart_'.($i-1).'_cart_code']+1;
    $pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
    $ary=getDBSql($pdo,'SELECT * FROM d_item WHERE item_code = '.$_POST['code']);
    // echo json_encode($ary);
    $_SESSION['cart_'.$i.'_os_id'] = $ary[0]['os_id'];
    $_SESSION['cart_'.$i.'_cpu_id'] = $ary[0]['cpu_id'];
    $_SESSION['cart_'.$i.'_memory_id'] = $ary[0]['memory_id'];
    $_SESSION['cart_'.$i.'_gpu_id'] = $ary[0]['gpu_id'];
    $_SESSION['cart_'.$i.'_ssd_id'] = $ary[0]['ssd_id'];
    $_SESSION['cart_'.$i.'_hdd_id'] = $ary[0]['hdd_id'];
    $_SESSION['cart_'.$i.'_price'] = $ary[0]['price'];
  }
  else if ($_POST['mode'] == 'delete') {
    for ($n = 1;$n <= (int)$_SESSION['cart_num']; $n++) {
      //同じコードのものを削除
      if ((int)$_SESSION['cart_'.$n.'_cart_code'] == (int)$_POST['code']) {
        $isset = true;
        for ($l = $n;$l < (int)$_SESSION['cart_num']; $l++) {
          $_SESSION['cart_'.$l.'_item_code'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_item_code'];
          $_SESSION['cart_'.$l.'_cart_code'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_cart_code'];
          $_SESSION['cart_'.$l.'_os_id'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_os_id'];
          $_SESSION['cart_'.$l.'_cpu_id'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_cpu_id'];
          $_SESSION['cart_'.$l.'_memory_id'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_memory_id'];
          $_SESSION['cart_'.$l.'_gpu_id'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_gpu_id'];
          $_SESSION['cart_'.$l.'_ssd_id'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_ssd_id'];
          $_SESSION['cart_'.$l.'_hdd_id'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_hdd_id'];
          $_SESSION['cart_'.$l.'_price'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_price'];
        }
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_item_code']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_cart_code']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_os_id']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_cpu_id']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_memory_id']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_gpu_id']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_ssd_id']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_hdd_id']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_price']);
        $_SESSION['cart_num']--;
        break;
      }
    }
  }
}
else if ($_POST['base'] == 'excart') {
  $i = ++$_SESSION['cart_num'];
  $_SESSION['cart_'.$i.'_item_code'] = $_POST['code'];
  $_SESSION['cart_'.$i.'_cart_code'] = $i == 1 ? 1 : $_SESSION['cart_'.($i-1).'_cart_code']+1;
  $_SESSION['cart_'.$i.'_os_id'] = $_POST['os_id'];
  $_SESSION['cart_'.$i.'_cpu_id'] = $_POST['cpu_id'];
  $_SESSION['cart_'.$i.'_memory_id'] = $_POST['memory_id'];
  $_SESSION['cart_'.$i.'_gpu_id'] = $_POST['gpu_id'];
  $_SESSION['cart_'.$i.'_ssd_id'] = $_POST['ssd_id'];
  $_SESSION['cart_'.$i.'_hdd_id'] = $_POST['hdd_id'];
  $_SESSION['cart_'.$i.'_price'] = $_POST['price'];
}
?>