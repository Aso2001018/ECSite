<?php
require 'header.php';
require 'connect-php/getItem.php';
$ary=getDbSql('SELECT * FROM m_case');
?>
<div class="title"id="title">
  <h2>ケース一覧</h2>
  <div class="itemnum"id="itemnum">
    <?=count($ary)?>個の商品
  </div>
</div>
<div class="item_area" id="item_area">
<?php
$itemNum=0;
foreach($ary as $item) {
  echo'
  <hr>
  <div class="item">
    <div class="item_img">
      <a href="#">
        <img id="item_img_',$itemNum,'"src="',$item['imgurl'],'">
      </a>
    </div>
    <div class="item_noimage">
      <div class="item_name">',$item['name'],'</div>
      <div class="item_price"id="item_price">',getPriceText($item['price'],false),'(税込)</div>
      <div class="item_button">
        <form method="get"action="customize.php">
          <input type="hidden"name="id"value="1">
          <input type="hidden"name="OS"value="1">
          <input type="hidden"name="CPU"value="1">
          <input type="hidden"name="RAM"value="1">
          <input type="hidden"name="GPU"value="1">
          <input type="hidden"name="SSD"value="1">
          <input type="hidden"name="HDD"value="1">
          <button type="submit"class="button_itemdetail">カスタマイズ</button>
        </form>
      </div>
    </div>
  </div>
  <script>
  Evt(Id(\'item_img_',$itemNum,'\'),\'error\',recoverImg);
  </script>
  ';
  $itemNum++;
}
?>
</div>
<?php require 'footer.php'?>