let cartItemData=[];
let cartItemList=[];
let cartItemCode=[];

let masterPrice=0;
let itemNum=0;
window.onload=function(){
  if (cartItemList.length==0)cartItemList.push(-1);
  let ary = Array('table','d_item','code',1);
  for(let i = 0;i<cartItemList.length;i++) {
    ary.push('code_'+i,cartItemList[i]);
  }
  ary.push('list',cartItemList.length);
  getDbResponseArray(setCartItem,ary);
}
function setCartItem() {
  const div=Id('item_area');
  Log(cartItemList);
  Log(cartItemCode);
  Log(this.response);
  if(this.response==null) {
    add(
      div,
      cHr(),
      cText('カートは空です。')
    );
  }
  else {
    this.response.forEach(val=>{
      cartItemData.push(new cartItemDataStruct('#',val['imgurl'],val['item_name'],'',val['price'],val['isfav'],val['item_code'],val['os_id'],val['cpu_id'],val['memory_id'],val['gpu_id'],val['ssd_id'],val['hdd_id']));
    });
    itemNum=cartItemData.length;
    if(itemNum==0) {
      add(
        div,
        cHr(),
        cText('カートは空です。')
      );
    }
    else {
      cartItemData.forEach(val=>{
        add(
          div,
          cHr(),
          val.object
        );
        masterPrice+=val.price;
      });
    }
  }
  add(Id('cont'),setOkButton());
}
function setOkButton() {
  return add(
    cDiv('class','ok'),
    add(
      add(
        cDiv('class','sum'),
        cText('合計')
      ),
      add(
        cSpan(),
        cText(getPriceText(masterPrice)+'(税込)')
      )
    ),
    add(
      cDiv('class','ok_button'),
      add(
        cButton('type','button'),
        cText('購入する')
      )
    )
  );
}

/**カート内データの作成*/
class cartItemDataStruct extends itemDataStruct{
  constructor(href,img,name,html,price,isfav,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id) {
    super(href,img,name,html,price,true,isfav,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id);
  }
}