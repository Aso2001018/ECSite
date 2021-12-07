<?php
require 'header.php';
require 'connect/getDBSql.php';
$pdo=new PDO('mysql:host=mysql153.phy.lolipop.lan;dbname=LAA1290643-sd2a03dev;charset=utf8','LAA1290643','sd2adevelopment');
function push($parent,...$childs) {
  foreach($childs as $child) {
    array_push($parent,$child);
  }
  return $parent;
}
class Detail{
  public $id;
  public $name;
  public $price;
  public $checked;
  public function __construct(int $id, string $name, int $price, bool $checked) {
    $this->id=$id;
    $this->name=$name;
    $this->price=$price;
    $this->checked=$checked;
  }
}
class Kind{
  public $name;
  public $details;
  public function __construct(string $name) {
    $this->name=$name;
    $this->details=[];
  }
  public function pushDetail(int $id,string $name,int $price,bool $checked) {
    $this->details=push($this->details,new Detail($id,$name,$price,$checked));
  }
}
$kindList=[];
$kindList=push($kindList,
      new Kind('os'),
      new Kind('cpu'),
      new Kind('memory'),
      new Kind('gpu'),
      new Kind('ssd'),
      new Kind('hdd'));
$dispcost = 0;
foreach($kindList as $kind) {
  $ary=getDBSql($pdo, 'SELECT * FROM m_'.$kind->name);
  $unsetflg = false;
  foreach($ary as $val) {
    if ((!empty($_POST[$kind->name.'_id']) && $_POST[$kind->name.'_id'] == $val[$kind->name.'_id']) || (empty($_POST[$kind->name.'_id']) && !$unsetflg)) {
      $kind->pushDetail($val[$kind->name.'_id'],$val['name'],$val['price'],true);
      $dispcost += $val['price'];
      echo'<script>Log(',$val['price'],');</script>';
      $unsetflg = true;
    }
    else {
      $kind->pushDetail($val[$kind->name.'_id'],$val['name'],$val['price'],false);
    }
  };
}
echo'<script>Log(',$dispcost,');</script>';
echo '<div id="data_stack"style="display:none"><script>itemCode=',$_POST['item_code'],';';
$i=0;
foreach($kindList as $kind) {
  echo 'kindData.push(\'',$kind->name,'\');';
  echo '{let phparray=new Array();';
  $n=0;
  foreach($kind->details as $detail) {
    if ($detail->checked)
      echo 'detailCheck[',$i,']=',$n,';';
    echo 'phparray.push(new Detail(',$detail->id,',\'',$detail->name,'\',',$detail->price,'));';
    $n++;
  };
  echo 'detailData.push(phparray);}';
  $i++;
}
echo 'remChild(Id(\'cont\'),Id(\'data_stack\'));</script></div>';
?>
<div class="customize_area"id="customize_area">
  <div class="nowconposition"id="nowconposition">
    <div class="img_area"id="img_area">
      <img src="../image/NoImage.png">
    </div>
    <div class="partslist"id="partslist">
<?php
foreach ($kindList as $kind) {
  echo'<div id="part_',$kind->name,'"style="width:100%;">';
  foreach ($kind->details as $detail) {
    if ($detail->checked) {
      echo$detail->name;
    }
  }
  echo'</div>';
}
?>
      <div class="part_price"id="part_price"style="width:100%;">
        <b id="p_price">
        </b>
        <script id="price_scr">
          Id('p_price').textContent = getPriceText(<?=$dispcost?>);
          remChild(Id('part_price'),Id('price_scr'));
        </script>
      </div>
    </div>
    <div class="buttonincart"id="buttonincart">
      <button class="incart"id="incart"type="button">カスタマイズ・お見積りを完了する。</button>
    </div>
  </div>
  <div class="selector"id="selector">
    <div class="kindselector"id="kindselector">
<?php
foreach ($kindList as $kind) {
  echo'<input type="radio"name="kind"value="',$kind->name,'"id="kind_',$kind->name,'"';
  if ($kind->name=="os") echo'checked';
  echo'><label for="kind_',$kind->name,'">',strtoupper($kind->name),'</label>';
}
?>
    </div>
    <div class="detailselector"id="detailselector">
      <?php
        foreach ($kindList[0]->details as $detail) {
          echo'<input type="radio"name="detail"value="',$detail->id,'"id=detail=_"',$detail->id,'"';
          if($detail->checked)
            echo' checked>';
          else
            echo'>';
          echo'<label for="detail_',$detail->id,'">',$detail->name,'<abbr id="detail_price_',$detail->id,'"></abbr>';
          echo'<script>Id("detail_price_',$detail->id,'").textContent=getPriceText(',$detail->price,'-detailData[0][detailCheck[0]].price,true);</script></label>';
          /*
<input type="radio"name="detail"value="0"id="detail_0">
<label for="detail_0">a<abbr>¥0</abbr></label>
getPriceText(detailData[radioValue][i].price-detailData[radioValue][detailCheck[radioValue]].price,true)
          */
        } 
      ?>
    </div>
  </div>
</div>
<?php require 'footer.php'?>