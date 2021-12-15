<?php
function getPriceText($d,$f){
  $s=strval($d);$l=strlen($s);$r='';
  for($i=0;$i<$l;$i+=3){
    $c=$l-$i>3;
    $r=substr($s,$c?$l-$i-3:0,$c?3:$l-$i).($i==0?'':',').$r;
  }
  return $d<0?'-¥'.substr($r,1):$f&&$d>0?'+¥'.$r:'¥'.$r;
}
function setItemData($href,$img,$name,$html,$price,$isfav,$item,$os,$cpu,$ram,$gpu,$ssd,$hdd,$idn,$iscart,$cart=-1,$nobutton=false){
  echo'
  <hr>
  <div class="item">
    <div class="item_img">
      <a href="',$href,'">
        <img id="item_img_',$idn,'"src="',$img,'">
      </a>
    </div>
    <div class="item_noimage">
      <div class="item_name">',$name,'</div>
      <div class="item_desc">',$html,'</div>
      <div class="item_price"id="item_price">',getPriceText($price,false),'(税込)',$iscart?'':'～','</div>
      <div class="item_button">
        <form method="get"action="customize.php">
          <input type="hidden"name="id"value="',$item,'">
          <input type="hidden"name="OS"value="',$os,'">
          <input type="hidden"name="CPU"value="',$cpu,'">
          <input type="hidden"name="RAM"value="',$ram,'">
          <input type="hidden"name="GPU"value="',$gpu,'">
          <input type="hidden"name="SSD"value="',$ssd,'">
          <input type="hidden"name="HDD"value="',$hdd,'">
          <button type="submit"class="button_itemdetail"',$nobutton?'style="display:none;"':'','>カスタマイズ</button>
        </form>
        <button type="button"id="cart_button_',$idn,'"class="button_',$iscart?'delete"':'addcart"',$nobutton?'style="display:none;"':'','>カート',$iscart?'から削除':'へ追加','</button>
        <input type="checkbox"class="check_favorite"id="check_favorite_',$item,'"',$isfav?'checked':'','>
        <label class="button_favorite"id="button_favorite_',$idn,'"for="check_favorite_',$item,'"',$_SESSION['login']&&!$iscart||$nobutton?'':'style="display:none"','>
          <i class="fas fa-heart"',$_SESSION['login']&&!$iscart?'':'style="display:none"','></i>
        </label>
      </div>
    </div>
  </div>
  <script id="sc_',$idn,'">
  Evt(Id(\'item_img_',$idn,'\'),\'error\',recoverImg);
  Evt(Id(\'cart_button_',$idn,'\'),\'click\',',$iscart?'delete':'add','Cart.bind(',$iscart?$cart:$item,'));
  Evt(Id(\'button_favorite_',$idn,'\'),\'click\',fixFav.bind(',$item,'));
  </script>
  ';  
}
?>