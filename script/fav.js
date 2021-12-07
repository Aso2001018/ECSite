let favItemData=[];
let favItemList=[];
window.onload=function(){
  if (favItemList.length==0)favItemList.push(-1);
  let ary = Array('table','d_item','code',1);
  for(let i = 0;i<favItemList.length;i++) {
    ary.push('code_'+i,favItemList[i]);
  }
  ary.push('list',favItemList.length);
  getDbResponseArray(setFavItem,ary);
}
let itemNum;
function setFavItem() {
  const div=Id('item_area');
  Log(this.response);
  if(this.response==null) {
    add(
      div,
      cHr(),
      cText('お気に入り商品はありません。')
    );
  }
  else {
    this.response.forEach(val=>{
      favItemData.push(new favItemDataStruct('#',val['imgurl'],val['item_name'],'',val['price'],val['isfav'],val['item_code'],val['os_id'],val['cpu_id'],val['memory_id'],val['gpu_id'],val['ssd_id'],val['hdd_id']));
    });
    itemNum=favItemData.length;
    if (itemNum==0){
      add(
        div,
        cHr(),
        cText('お気に入り商品はありません。')
      );
    }
    else {
      favItemData.forEach(val=>{
        add(
          div,
          cHr(),
          val.object
        );
      });
    }
  }
  //document.getElementById('itemnum').innerHTML=itemNum+'個の商品';
}
class favItemDataStruct extends itemDataStruct{
  constructor(href,img,name,html,price,isfav,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id) {
    Log(isfav);
    super(href,img,name,html,price,false,isfav,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id);
    this.sortPrice=0;
    for(let i=0;i<favItemData.length;i++){
      if(favItemData[i].price<=this.price)
        this.sortPrice++;
      else
        favItemData[i].sortPrice++;
    }
  }
}