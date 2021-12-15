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
      <input type="image"name="submit"src="',$img,'">
    </form>
  </li>';
}
setSliderItem(1,1,1,1,1,1,1,'../image/color_blue.png');
setSliderItem(1,1,1,1,1,1,1,'../image/color_green.png');
setSliderItem(1,1,1,1,1,1,1,'../image/color_orange.png');
setSliderItem(1,1,1,1,1,1,1,'../image/color_black.png');
setSliderItem(1,1,1,1,1,1,1,'../image/color_red.png');
setSliderItem(1,1,1,1,1,1,1,'../image/color_yellow.png');
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
        <button name="Type"value="0"type="submit"class="peri">周辺機器</button>
      </form>
    </div>
  </div>
</div>
<!---------------------------------------->
<div class="item_area">
  <h2>ケースを選択する</h2>
  <div class="item_area_detail"id="item_area_detail">
<?php
$ary=getDbSql('SELECT * FROM m_case LIMIT 0,3');
$cnt=0;
foreach($ary as $item) {
  echo '
  <div class="items">
    <h4>',$item['name'],'</h4>
    <div class="item_pic">
      <a><img id="case_img_',$cnt,'" src="',$item['imgurl'],'"></a>
    </div>
    <form method="get"action="customize.php">
      <input name="id"value="1"style="display:none">
      <input name="OS"value="1"style="display:none">
      <input name="CPU"value="1"style="display:none">
      <input name="RAM"value="1"style="display:none">
      <input name="GPU"value="1"style="display:none">
      <input name="SSD"value="1"style="display:none">
      <input name="HDD"value="1"style="display:none">
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
