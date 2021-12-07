<?php
require 'header.php';
require 'connect/getDBSql.php';
$pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
?>
<div class="search_area"id="search_area">
  <div class="search_box s_keyword">
    キーワード
    <div class="search_info">
      <input type="text"id="s_keyword"placeholder="キーワード"value="<?php if(!empty($_POST['s_keyword']))echo$_POST['s_keyword'];?>">
    </div>
  </div>
  <div class="price">
    <div class="search_box">
      金額(下限)
      <div class="search_info">
        <input type="number"id="s_minvalue"value="<?php if(!empty($_POST['s_minvalue']))echo$_POST['s_minvalue'];?>">
        <i class="fas fa-yen-sign fa-lg fa-fw"aria-hidden="true"></i>
      </div>
    </div>
    <div class="line">
      <p>～</p>
    </div>
    <div class="search_box">
      金額(上限)
      <div class="search_info">
        <input type="number"id="s_maxvalue"value="<?php if(!empty($_POST['s_maxvalue']))echo$_POST['s_maxvalue'];?>">
        <i class="fas fa-yen-sign fa-lg fa-fw"aria-hidden="true"></i>
      </div>
    </div>
  </div>
  <div class="search_box s_pc_cate">
    形状
    <div class="search_info">
      <select id="s_type">
        <option value=0>指定なし</option>
<?php
$ary=getDBSql($pdo,'SELECT * FROM m_pc_cate');
foreach($ary as$val) {
  echo '<option value=',$val['pc_cate_id'];
  if (isset($_POST['s_type']) && $val['pc_cate_id']==$_POST['s_type']) echo ' selected';
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
      <select id="s_cpu">
        <option value=0>指定なし</option>
<?php
$ary=getDBSql($pdo,'SELECT * FROM m_cpu');
foreach($ary as$val) {
  echo '<option value=',$val['cpu_id'];
  if (isset($_POST['s_cpu']) && $val['cpu_id']==$_POST['s_cpu']) echo ' selected';
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
      <select id="s_ram"value=<?=$_POST['s_ram']?>>
        <option value=0>指定なし</option>
<?php
$ary=getDBSql($pdo,'SELECT * FROM m_memory');
foreach($ary as$val) {
  echo '<option value=',$val['memory_id'];
  if (isset($_POST['s_memory']) && $val['memory_id']==$_POST['s_memory']) echo ' selected';
  echo '>',$val['name'],'</option>';
};
$pdo=null;
?>
      </select>
      <i class="fas fa-sd-card fa-lg fa-fw"aria-hidden="true"></i>
    </div>
  </div>
  <div class="search_box s_button">
    <button type="button"id="runSearch">検索</button>
  </div>
</div>
<div class="item_area"id="item_area">
  <div class="item_area_menu">
    <li>
      <span id="hitnum">0</span>件のヒット
    </li>
    <li>並び替え</li>
    <li class="sort_button"><button type="button"id="sort_abc">五十音順</button></li>
    <li class="sort_button"><button type="button"id="sort_low">低価格順</button></li>
    <li class="sort_button"><button type="button"id="sort_high">高価格順</button></li>
    <li class="sort_button"><button type="button"id="sort_new">新製品順</button></li>
    <li class="sort_button"><button type="button"id="sort_old">旧製品順</button></li>
  </div>
</div>
<hr>
<div class="hititem_area"id="hititem_area">
</div>
<?php require 'footer.php'?>