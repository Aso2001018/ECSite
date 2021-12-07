<?php require 'header.php'?>
<?php
echo'<script>';
for ($i = 1; $i <= $_SESSION['fav_num']; $i++) {
  echo'favItemList.push('.$_SESSION['fav_'.$i.'_item_code'].');';
}
echo'</script>';
?>
<div class="title" id="title">
  <h2>お気に入り</h2>
  <div class="itemnum"id="itemnum">
    <?=$_SESSION['fav_num']?>個の商品
  </div>
</div>
<div class="item_area" id="item_area"></div>
<?php require 'footer.php'?>