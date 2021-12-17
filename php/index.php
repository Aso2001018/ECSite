<?php
require 'header.php';
?>
<h2>BTOパソコンサイト<i class="fas fa-desktop"></i></h2>
<div class="mainVisual"id="mainVisual">
  <div class="arrow_left"id="arrow_left"></div>
  <ul class="slider" id="slider">
<?php
function setSliderItem($item,$os,$cpu,$ram,$gpu,$ssd,$hdd,$img) {
  echo '
  <li>
    <form method="get"action="customize.php">
      <input type="hidden"name="id"value="',$item,'">
      <input type="hidden"name="OS"value="',$os,'">
      <input type="hidden"name="CPU"value="',$cpu,'">
      <input type="hidden"name="RAM"value="',$ram,'">
      <input type="hidden"name="GPU"value="',$gpu,'">
      <input type="hidden"name="SSD"value="',$ssd,'">
      <input type="hidden"name="HDD"value="',$hdd,'">
      <input type="image"name="submit"src="',$img,'"id="slider_img_',$item,'">
    </form>
  </li>
  <script id="slider_scr_',$item,'">
  Evt(Id(\'slider_img_',$item,'\'),\'error\',recoverImg);
  remChild(Id(\'slider\'),Id(\'slider_scr_',$item,'\'));
  </script>
  ';
}
$ary=getDbSql('SELECT * FROM d_item ORDER BY RAND() LIMIT 0,6');
foreach($ary as $d) {
  setSliderItem($d['id'],$d['OS'],$d['CPU'],$d['RAM'],$d['GPU'],$d['SSD'],$d['HDD'],$d['imgurl']);
}
// setSliderItem(1,1,1,1,1,1,1,'../image/color_blue.png');
// setSliderItem(1,1,1,1,1,1,1,'../image/color_green.png');
// setSliderItem(1,1,1,1,1,1,1,'../image/color_orange.png');
// setSliderItem(1,1,1,1,1,1,1,'../image/color_black.png');
// setSliderItem(1,1,1,1,1,1,1,'../image/color_red.png');
// setSliderItem(1,1,1,1,1,1,1,'../image/color_yellow.png');
?>
  </ul>
  <div class="arrow_right"id="arrow_right"></div>
  <div class="slider_point"id="slider_point"></div>
</div>
<div class="middle_area">
  <div class="search_area">
    <form method="get"action="search.php">
      <h3>スペックから探す</h3>
      <div class="search_box s_keyword">
        キーワード
        <div class="search_info">
          <input type="text" name="Key" placeholder="キーワード">
          <i class="fas fa-key fa-lg fa-fw" aria-hidden="true"></i>
        </div>
      </div>
      <div class="price">
        <div class="search_box">
          金額(下限)
          <div class="search_info">
            <input type="number"name="Min">
            <i class="fas fa-yen-sign fa-lg fa-fw" aria-hidden="true"></i>
          </div>
        </div>
        <div class="line">
          <p>～</p>
        </div>
        <div class="search_box">
          金額(上限)
          <div class="search_info">
            <input type="number"name="Max">
            <i class="fas fa-yen-sign fa-lg fa-fw" aria-hidden="true"></i>
         </div>
        </div>
      </div>
      <div class="search_box s_pc_cate">
        形状
        <div class="search_info">
          <select name="Type">
            <option value=0>指定なし</option>
<?php
$ary=getDBSql('SELECT id, name FROM m_type');
foreach($ary as $val) {
  echo '<option value=',$val['id'],'>',$val['name'],'</option>';
};
?>
          </select>
          <i class="fas fa-shapes fa-lg fa-fw" aria-hidden="true"></i>
        </div>
      </div>
      <div class="search_box s_cpu">
        CPU
        <div class="search_info">
          <select name="CPU">
            <option value=0>指定なし</option>
<?php
$ary=getDBSql('SELECT id, name FROM m_cpu');
foreach($ary as$val) {
  echo '<option value=',$val['id'],'>',$val['name'],'</option>';
};
?>
          </select>
          <i class="fas fa-microchip fa-lg fa-fw" aria-hidden="true"></i>
        </div>
      </div>
      <div class="search_box s_ram">
        メモリ
        <div class="search_info">
          <select name="RAM">
            <option value=0>指定なし</option>
<?php
$ary=getDBSql('SELECT id, name FROM m_ram');
foreach($ary as$val) {
  echo '<option value=',$val['id'],'>',$val['name'],'</option>';
};
?>
          </select>
          <i class="fas fa-sd-card fa-lg fa-fw" aria-hidden="true"></i>
        </div>
      </div>
      <div class="search_box">
        <button type="submit">検索</button>
      </div>
    </form>
  </div>
  <div class="cate_area">
    <h3>カテゴリから探す</h3>
    <div class="cate_button_area">
      <form method="get"action="search.php">
        <button name="Type"value="2"type="submit"class="desk">デスクトップPC</button>
        <button name="Type"value="3"type="submit"class="note">ノートPC</button>
        <button name="Type"value="1"type="submit"class="game">ゲーミングPC</button>
        <button name="Type"value="4"type="submit"class="create">クリエイター向けPC</button>
        <button name="Type"value="5"type="submit"class="peri">周辺機器</button>
      </form>
    </div>
  </div>
</div>
<!---------------------------------------->
<div class="item_area">
  <h2>ケースを選択する</h2>
  <div class="item_area_detail"id="item_area_detail">
<?php
$ary=getDbSql('SELECT 
d_item.id AS ID, 
m_case.name AS NAME, 
d_item.OS AS OS, 
d_item.CPU AS CPU, 
d_item.RAM AS RAM, 
d_item.GPU AS GPU, 
d_item.SSD AS SSD, 
d_item.HDD AS HDD, 
m_case.imgurl AS IMG 
FROM m_case, d_item WHERE m_case.item = d_item.id LIMIT 0,3;');
$cnt=0;
foreach($ary as $item) {
  echo '
  <div class="items">
    <h4>',$item['NAME'],'</h4>
    <div class="item_pic">
      <a><img id="case_img_',$cnt,'" src="',$item['IMG'],'"></a>
    </div>
    <form method="get"action="customize.php">
      <input name="id"value="',$item['ID'],'"style="display:none">
      <input name="OS"value="',$item['OS'],'"style="display:none">
      <input name="CPU"value="',$item['CPU'],'"style="display:none">
      <input name="RAM"value="',$item['RAM'],'"style="display:none">
      <input name="GPU"value="',$item['GPU'],'"style="display:none">
      <input name="SSD"value="',$item['SSD'],'"style="display:none">
      <input name="HDD"value="',$item['HDD'],'"style="display:none">
      <button type="submit">カスタマイズ</button>
    </form>
  </div>
  <script id="sc_',$cnt,'">
  Evt(Id(\'case_img_',$cnt,'\'),\'error\',recoverImg);
  </script>
  ';
  $cnt++;
}
?>
  </div>
  <a class="more_item"href="case.php">もっと見る<i class="fas fa-angle-double-right"></i></a>
</div>
<?php require 'footer.php'?>
