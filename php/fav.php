<?php
require 'header.php';
require 'connect-php/getItem.php';
$sql = 'SELECT 
d_item.id AS id, 
d_item.name AS Name, 
d_item.OS AS OS, 
d_item.CPU AS CPU, 
d_item.RAM AS RAM, 
d_item.GPU AS GPU, 
d_item.SSD AS SSD, 
d_item.HDD AS HDD, 
d_item.imgurl AS IMG, 
m_os.name AS OSName, 
m_cpu.name AS CPUName, 
m_ram.name AS RAMName, 
m_gpu.name AS GPUName, 
m_ssd.name AS SSDName, 
m_hdd.name AS HDDName, 
d_item.price + m_os.price + m_cpu.price + m_ram.price + m_gpu.price + m_ssd.price + m_hdd.price AS Price 
FROM d_fav, d_item, m_os, m_cpu, m_ram, m_gpu, m_ssd, m_hdd 
WHERE d_item.OS = m_os.id 
AND d_item.CPU = m_cpu.id 
AND d_item.RAM = m_ram.id 
AND d_item.GPU = m_gpu.id 
AND d_item.SSD = m_ssd.id 
AND d_item.HDD = m_hdd.id 
AND d_fav.item = d_item.id 
AND d_fav.user = '.$_SESSION['user_id'].';';
$ary=getDbSql($sql);
?>
<div class="title" id="title">
  <h2>お気に入り</h2>
  <div class="itemnum"id="itemnum">
    <?=count($ary)?>個の商品
  </div>
</div>
<div class="item_area" id="item_area">
<?php
if (count($ary) > 0) {

  $itemDrawNum = 0;
  foreach($ary as $item) {
    setItemData(
      '#',
      $item['IMG'],
      $item['Name'],'OS : '.
      $item['OSName'].'<br> CPU : '.
      $item['CPUName'].'<br> RAM : '.
      $item['RAMName'].'<br> GPU : '.
      $item['GPUName'].'<br> SSD : '.
      $item['SSDName'].'<br> HDD : '.
      $item['HDDName'],
      intval($item['Price']),
      true,
      $item['id'],
      $item['OS'],
      $item['CPU'],
      $item['RAM'],
      $item['GPU'],
      $item['SSD'],
      $item['HDD'],
      $itemDrawNum,
      false
    );
    $itemDrawNum++;
  }
}
else {
  echo'<hr>お気に入り商品はありません。';
}
?>
</div>
<?php require 'footer.php'?>