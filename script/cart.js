class CartItem{
  constructor(item_code,cart_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id,price) {
    this.item_code=item_code;
    this.cart_code=cart_code;
    this.os_id=os_id;
    this.cpu_id=cpu_id;
    this.ram_id=ram_id;
    this.gpu_id=gpu_id;
    this.ssd_id=ssd_id;
    this.hdd_id=hdd_id;
    this.price=price;
  }
}
let cartItemDataList=[];
let cartItemList=[];

let masterPrice=0;
let itemNum=0;
window.onload=function(){
  // if (cartItemList.length==0)cartItemList.push(new CartItem(-1,-1,-1,-1,-1,-1,-1,-1,-1));
  // let ary = Array('table','d_item','code',1);
  // for(let i = 0;i<cartItemList.length;i++) {
  //   ary.push('code_'+i,cartItemList[i].item_code);
  // }
  // ary.push('list',cartItemList.length);
  // getDbResponseArray(setCartItem,ary);
}
function setCartItem() {
  const div=Id('item_area');
  if(this.response==null) {
    add(
      div,
      cHr(),
      cText('カートは空です。')
    );
  }
  else {
    this.response.forEach(val=>{
      cartItemDataList.push(new cartItemDataStruct('#',val['imgurl'],val['item_name'],'',val['price'],val['isfav'],val['item_code'],val['os_id'],val['cpu_id'],val['memory_id'],val['gpu_id'],val['ssd_id'],val['hdd_id']));
    });
    itemNum=cartItemDataList.length;
    if(itemNum==0) {
      add(
        div,
        cHr(),
        cText('カートは空です。')
      );
    }
    else {
      cartItemList.forEach(ci=>{
        cartItemDataList.forEach(cids=>{
          if (ci.item_code == cids.item_code) {
            let addCIDS = copyCIDS(cids,ci);
            add(
              div,
              cHr(),
              addCIDS.object
            );
            masterPrice+=ci.price;
          }
        });
      });
      add(Id('cont'),setOkButton());
    }
  }
}

/*
<div class="ok">
  <div class="sum">合計<span>(税込)</span></div>
  <div class="ok_button">
    <button type="button">購入する</button>
  </div>
</div>
*/
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
  constructor(href,img,name,html,price,isfav,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id,cart_id) {
    super(href,img,name,html,price,true,isfav,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id,cart_id);
  }
}
function copyCIDS(cids,ci) {
  return new cartItemDataStruct(
    cids.href,
    cids.img,
    cids.name,
    cids.html,
    ci.price,
    cids.isfav,
    cids.item_code,
    ci.os_id,
    ci.cpu_id,
    ci.ram_id,
    ci.gpu_id,
    ci.ssd_id,
    ci.hdd_id,
    ci.cart_code
  );
}