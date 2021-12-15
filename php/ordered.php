<?php 
require 'header.php';
require 'connect-php/getDBSql.php';
$ary=getDbSql('SELECT 
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
FROM d_order, d_order_detail, d_cart, d_item, m_os, m_cpu, m_ram, m_gpu, m_ssd, m_hdd
WHERE d_order.id = d_order_detail.order 
AND d_cart.id = d_order_detail.cart 
AND d_cart.item = d_item.id 
AND d_cart.OS = m_os.id 
AND d_cart.CPU = m_cpu.id 
AND d_cart.RAM = m_ram.id 
AND d_cart.GPU = m_gpu.id 
AND d_cart.SSD = m_ssd.id 
AND d_cart.HDD = m_hdd.id 
AND d_order.id = '.$_SESSION['order_id'].'
;');
?>
<div class="title"id="title">
  <h2>商品の購入が完了しました</h2>
</div>
<hr>
<?php
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
    $item['Price'],
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
}

?>
<?php require 'footer.php'?>