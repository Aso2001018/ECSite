<?php
require 'header.php';
require 'connect-php/getDBSql.php';
require 'connect-php/getItem.php';
?>
<form method="get"action="search.php">
  <div class="search_area"id="search_area">
    <div class="search_box s_keyword">
      キーワード
      <div class="search_info">
        <input type="text"id="s_keyword"name="Key"placeholder="キーワード"value="<?php if(!empty($_GET['Key']))echo$_GET['Key'];?>">
      </div>
    </div>
    <div class="price">
      <div class="search_box">
        金額(下限)
        <div class="search_info">
          <input type="number"id="s_minvalue"name="Min"value="<?php if(!empty($_GET['Min']))echo$_GET['Min'];?>">
          <i class="fas fa-yen-sign fa-lg fa-fw"aria-hidden="true"></i>
        </div>
      </div>
      <div class="line">
        <p>～</p>
      </div>
      <div class="search_box">
        金額(上限)
        <div class="search_info">
          <input type="number"id="s_maxvalue"name="Max"value="<?php if(!empty($_GET['Max']))echo$_GET['Max'];?>">
          <i class="fas fa-yen-sign fa-lg fa-fw"aria-hidden="true"></i>
        </div>
      </div>
    </div>
    <div class="search_box s_pc_cate">
      形状
      <div class="search_info">
        <select id="s_type"name="Type">
          <option value=0>指定なし</option>
<?php
$ary=getDbSql('SELECT id, name FROM m_type');
foreach($ary as$val) {
  echo '<option value=',$val['id'];
  if (isset($_GET['Type']) && $val['id']==$_GET['Type']) echo ' selected';
  echo '>',$val['name'],'</option>';
};
?>
        </select>
        <i class="fas fa-shapes fa-lg fa-fw"aria-hidden="true"></i>
      </div>
    </div>
    <div class="search_box s_cpu">
      CPU
      <div class="search_info">
        <select id="s_cpu"name="CPU">
          <option value=0>指定なし</option>
<?php
$ary=getDbSql('SELECT id, name FROM m_cpu');
foreach($ary as$val) {
  echo '<option value=',$val['id'];
  if (isset($_GET['CPU']) && $val['id']==$_GET['CPU']) echo ' selected';
  echo '>',$val['name'],'</option>';
};
?>
        </select>
        <i class="fas fa-microchip fa-lg fa-fw"aria-hidden="true"></i>
      </div>
    </div>
    <div class="search_box s_ram">
      RAM
      <div class="search_info">
        <select id="s_ram"name="RAM">
          <option value=0>指定なし</option>
<?php
$ary=getDbSql('SELECT id, name FROM m_ram');
foreach($ary as$val) {
  echo '<option value=',$val['id'];
  if (isset($_GET['RAM']) && $val['id']==$_GET['RAM']) echo ' selected';
  echo '>',$val['name'],'</option>';
};
$pdo=null;
?>
        </select>
        <i class="fas fa-sd-card fa-lg fa-fw"aria-hidden="true"></i>
      </div>
    </div>
    <div class="search_box s_button">
      <button type="submit"id="runSearch">検索</button>
    </div>
  </div>
  <div class="item_area"id="item_area">
    <div class="item_area_menu">
      <li>
<?php
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
FROM d_item, m_os, m_cpu, m_ram, m_gpu, m_ssd, m_hdd 
WHERE d_item.OS = m_os.id 
AND d_item.CPU = m_cpu.id 
AND d_item.RAM = m_ram.id 
AND d_item.GPU = m_gpu.id 
AND d_item.SSD = m_ssd.id 
AND d_item.HDD = m_hdd.id';
if (!empty($_GET['Key'])) {
  $sql .= ' AND ';
  $sql .= 'd_item.name LIKE \'%'.$_GET['Key'].'%\'';
}
if (!empty($_GET['Min'])) {
  $sql .= ' AND ';
  $sql .= 'd_item.price >= '.$_GET['Min'];
}
if (!empty($_GET['Max'])) {
  $sql .= ' AND ';
  $sql .= 'd_item.price <= '.$_GET['Max'];
}
foreach (['Type','OS','CPU','RAM','GPU','SSD','HDD'] as $table) {
  if (!empty($_GET[$table])) {
    $sql .= ' AND ';
    $sql .= 'd_item.'.$table.' = '.$_GET[$table];
  }
}
if(!empty($_GET['sort'])) {
  switch($_GET['sort']) {
    case'abc':
      $sql .=' ORDER BY d_item.name ASC';
      break;
    case'low':
      $sql .=' ORDER BY Price ASC';
      break;
    case'high':
      $sql .=' ORDER BY Price DESC';
      break;
    case'new':
      $sql .=' ORDER BY d_item.reg_date DESC';
      break;
    case'old':
      $sql .=' ORDER BY d_item.reg_date ASC';
      break;
  }
}
$sql .= ';';
$ary = getDbSql($sql);
if (count($ary)==0) {
  echo '一致する商品が見つかりませんでした。';
}
else {
  echo '<span id="hitnum">',count($ary),'</span>件のヒット';
  echo '
      </li>
      <li>並び替え</li>
      <li class="sort_button"><button type="submit"name="sort"value="abc"id="sort_abc">五十音順</button></li>
      <li class="sort_button"><button type="submit"name="sort"value="low"id="sort_low">低価格順</button></li>
      <li class="sort_button"><button type="submit"name="sort"value="high"id="sort_high">高価格順</button></li>
      <li class="sort_button"><button type="submit"name="sort"value="new"id="sort_new">新製品順</button></li>
      <li class="sort_button"><button type="submit"name="sort"value="old"id="sort_old">旧製品順</button>';
}
?>
      </li>
    </div>
  </div>
</form>
<div class="hititem_area"id="hititem_area">
<?php
$itemDrawNum=0;
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
    count(getDbSql('SELECT * FROM d_fav, d_item WHERE d_fav.item = d_item.id AND d_fav.user = '.$_SESSION['user_id'].' AND d_item.id = '.$item['id']))==1,
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
?>
</div>
<?php require 'footer.php'?>