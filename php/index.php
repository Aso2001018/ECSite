<?php
require 'header.php';
require 'connect-php/getDBSql.php';
?>
<h2>BTOパソコンサイト<i class="fas fa-desktop"></i></h2>
<div class="mainVisual"id="mainVisual">
  <div class="arrow_left"id="arrow_left"></div>
  <ul class="slider" id="slider">
    <li><a href="#"><img src="../image/color_blue.png" alt=""></a></li>
    <li><a href="#"><img src="../image/color_green.png" alt=""></a></li>
    <li><a href="#"><img src="../image/color_orange.png" alt=""></a></li>
    <li><a href="#"><img src="../image/color_black.png" alt=""></a></li>
    <li><a href="#"><img src="../image/color_red.png" alt=""></a></li>
    <li><a href="#"><img src="../image/color_yellow.png" alt=""></a></li>
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
  </div>
  <a class="more_item"href="">もっと見る<i class="fas fa-angle-double-right"></i></a>
</div>
<?php require 'footer.php'?>
