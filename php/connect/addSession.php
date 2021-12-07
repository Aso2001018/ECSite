<?php
session_start();
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
  }
  else if ($_POST['mode'] == 'delete') {
    for ($n = 1;$n <= (int)$_SESSION['cart_num']; $n++) {
      //同じコードのものを削除
      if ((int)$_SESSION['cart_'.$n.'_cart_code'] == (int)$_POST['code']) {
        $isset = true;
        for ($l = $n;$l < (int)$_SESSION['cart_num']; $l++) {
          $_SESSION['cart_'.$l.'_item_code'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_item_code'];
          $_SESSION['cart_'.$l.'_cart_code'] = (int)$_SESSION[$_POST['base'].'_'.($l+1).'_cart_code'];
        }
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_item_code']);
        unset($_SESSION['cart_'.$_SESSION['cart_num'].'_cart_code']);
        $_SESSION['cart_num']--;
        break;
      }
    }
  }
}
array_push($ary,'end');
echo json_encode($ary);
?>