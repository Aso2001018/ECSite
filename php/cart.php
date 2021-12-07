<?php require 'header.php'?>
<?php
echo'<script>';
for ($i = 1; $i <= $_SESSION['cart_num']; $i++) {
  echo'cartItemList.push(new CartItem(',
    $_SESSION['cart_'.$i.'_item_code'],',',
    $_SESSION['cart_'.$i.'_cart_code'],',',
    $_SESSION['cart_'.$i.'_os_id'],',',
    $_SESSION['cart_'.$i.'_cpu_id'],',',
    $_SESSION['cart_'.$i.'_memory_id'],',',
    $_SESSION['cart_'.$i.'_gpu_id'],',',
    $_SESSION['cart_'.$i.'_ssd_id'],',',
    $_SESSION['cart_'.$i.'_hdd_id'],',',
    $_SESSION['cart_'.$i.'_price'],
  '));';
}
echo'</script>';
?>
<div class="title"id="title">
  <h2>カート</h2>
  <div class="itemnum"id="itemnum">
    <?=$_SESSION['cart_num']?>個の商品
  </div>
</div>
<div class="item_area" id="item_area"></div>
<?php require 'footer.php'?>
