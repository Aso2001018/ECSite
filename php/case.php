<?php
require 'header.php';
require 'connect-php/getItem.php';
$ary=getDbSql('SELECT 
d_item.id AS ID, 
m_case.name AS NAME, 
m_case.price AS PRICE, 
d_item.price + m_os.price + m_cpu.price + m_ram.price + m_gpu.price + m_ssd.price + m_hdd.price AS MASTERPRICE, 
d_item.OS AS OS, 
d_item.CPU AS CPU, 
d_item.RAM AS RAM, 
d_item.GPU AS GPU, 
d_item.SSD AS SSD, 
d_item.HDD AS HDD, 
m_case.imgurl AS IMG 
FROM m_case, m_os, m_cpu, m_ram, m_gpu, m_ssd, m_hdd, d_item 
WHERE m_case.item = d_item.id 
AND d_item.OS = m_os.id 
AND d_item.CPU = m_cpu.id 
AND d_item.RAM = m_ram.id 
AND d_item.GPU = m_gpu.id 
AND d_item.SSD = m_ssd.id 
AND d_item.HDD = m_hdd.id;');
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
        <img id="item_img_',$itemNum,'"src="',$item['IMG'],'">
      </a>
    </div>
    <div class="item_noimage">
      <div class="item_name">',$item['NAME'],'</div>
      <div class="item_desc">ケース単体価格:',getPriceText($item['PRICE'],false),'(税込)</div>
      <div class="item_price"id="item_price">',getPriceText($item['MASTERPRICE'],false),'(税込)～</div>
      <div class="item_button">
        <form method="get"action="customize.php">
          <input type="hidden"name="id"value="',$item['ID'],'">
          <input type="hidden"name="OS"value="',$item['OS'],'">
          <input type="hidden"name="CPU"value="',$item['CPU'],'">
          <input type="hidden"name="RAM"value="',$item['RAM'],'">
          <input type="hidden"name="GPU"value="',$item['GPU'],'">
          <input type="hidden"name="SSD"value="',$item['SSD'],'">
          <input type="hidden"name="HDD"value="',$item['HDD'],'">
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