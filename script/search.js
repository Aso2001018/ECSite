let hitItemNum = 0;

var hitItemData=[];

window.onload = function() {
  makeSearchArea();
  addEventSortArea();
  getSearchItem();
}

/**検索エリアの作成*/
function makeSearchArea() {
  Id('runSearch').addEventListener('click',getSearchItem);
}

/**ソートメニューのイベント設定*/
function addEventSortArea() {
  Id("sort_abc").addEventListener('click',getSearchItemSort.bind('name_asc'));
  Id("sort_low").addEventListener('click',getSearchItemSort.bind('price_asc'));
  Id("sort_high").addEventListener('click',getSearchItemSort.bind('price_desc'));
  Id("sort_new").addEventListener('click',getSearchItemSort.bind('date_desc'));
  Id("sort_old").addEventListener('click',getSearchItemSort.bind('date_asc'));
}

/**検索条件にヒットする商品データの取得*/
function getSearchItem() {
  const div=Id('hititem_area');
  delChild(div);
  add(div,cText('検索中...'));
  getDbResponse(setHitItemList,
    'table','d_item',
    'keyword',Id('s_keyword').value,
    'minvalue',Id('s_minvalue').value,
    'maxvalue',Id('s_maxvalue').value,
    'type',Id('s_type').value,
    'cpu',Id('s_cpu').value,
    'ram',Id('s_ram').value);
}

/**検索条件にヒットする商品データの取得
 * ソートモード追加版
*/
function getSearchItemSort() {
  const div=Id('hititem_area');
  delChild(div);
  add(div,cText('検索中...'));
  getDbResponse(setHitItemList,
    'table','d_item',
    'keyword',Id('s_keyword').value,
    'minvalue',Id('s_minvalue').value,
    'maxvalue',Id('s_maxvalue').value,
    'type',Id('s_type').value,
    'cpu',Id('s_cpu').value,
    'ram',Id('s_ram').value,
    this,1);
}

/**検索結果データをセットアップする。*/
function setHitItemList() {
  console.log(this.response);
  const div=Id('hititem_area');
  delChild(div);
  while(hitItemData.length>0)hitItemData.pop();
  if(this.response==null) {
    add(
      div,
      cText('一致する商品が見つかりませんでした。')
    );
  }
  else {
    this.response.forEach(val=>{
      hitItemData.push(new hitItemDataStruct('#',val['imgurl'],val['item_name'],'',val['price'],val['isfav'],val['item_code'],val['os_id'],val['cpu_id'],val['memory_id'],val['gpu_id'],val['ssd_id'],val['hdd_id']));
    });
    hitItemData.forEach(val=>{
      add(
        div,
        val.object,
        cHr()
      );
    });
    remChild(div,div.lastChild);
    hitItemNum = hitItemData.length;
    let dispNum = Id('hitnum');
    dispNum.innerHTML = hitItemNum;
  }
}

/**結果データの作成*/
class hitItemDataStruct extends itemDataStruct{
  constructor(href,img,name,html,price,isfav,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id) {
    super(href,img,name,html,price,false,isfav,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id);
  }
}