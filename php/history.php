<?php
require 'header.php';
require 'connect-php/getDBSql.php';
require 'connect-php/getItem.php';
$sql = 'SELECT 
d_item.id AS id, 
d_cart.id AS cart_id, 
d_item.name AS Name, 
d_cart.OS AS OS, 
d_cart.CPU AS CPU, 
d_cart.RAM AS RAM, 
d_cart.GPU AS GPU, 
d_cart.SSD AS SSD, 
d_cart.HDD AS HDD, 
d_item.imgurl AS IMG, 
m_os.name AS OSName, 
m_cpu.name AS CPUName, 
m_ram.name AS RAMName, 
m_gpu.name AS GPUName, 
m_ssd.name AS SSDName, 
m_hdd.name AS HDDName, 
d_order.order_date AS OrderDate, 
d_item.price + m_os.price + m_cpu.price + m_ram.price + m_gpu.price + m_ssd.price + m_hdd.price AS Price 
FROM d_cart, d_item, d_order, d_order_detail, m_os, m_cpu, m_ram, m_gpu, m_ssd, m_hdd 
WHERE d_cart.OS = m_os.id 
AND d_cart.CPU = m_cpu.id 
AND d_cart.RAM = m_ram.id 
AND d_cart.GPU = m_gpu.id 
AND d_cart.SSD = m_ssd.id 
AND d_cart.HDD = m_hdd.id 
AND d_cart.item = d_item.id 
AND d_cart.ordered = 1 
AND d_cart.id = d_order_detail.cart 
AND d_order_detail.orderid = d_order.id 
AND d_cart.user = '.$_SESSION['user_id'].' 
ORDER BY d_order.order_date DESC;';
$ary = getDbSql($sql);
?>
<div class="title"id="title">
  <h2>購入履歴</h2>
</div>
<div class="item_area" id="item_area">
<?php 
if (count($ary) == 0) {
  echo '<hr>購入履歴はありません。';
}
else {
  $date = $ary[0]['OrderDate'];
  echo '<hr><h3>',$date,'</h3>';
  echo'';
  $itemNum=0;
  foreach($ary as $item) {
    if ($date != $item['OrderDate']) {
      $date = $item['OrderDate'];
      echo '<hr><h3>',$date,'</h3>';
    }
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
      $item['Price'],
      true,
      $item['id'],
      $item['OS'],
      $item['CPU'],
      $item['RAM'],
      $item['GPU'],
      $item['SSD'],
      $item['HDD'],
      $itemNum,
      true,
      -1,
      true
    );
    $itemNum++;
  }
}
?>
</div>
<?php require 'footer.php'?>