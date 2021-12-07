class Detail{
  constructor(id,name,price){
    this.id=id;
    this.name=name;
    this.price=parseInt(price);
  }
}

let kindData     = new Array(),
    detailData   = new Array();

function getDetailIndexById(kind,id) {
  for (let i=0;i<detailData[kind].length;i++) {
    if (detailData[kind][i].id==id)
      return i;
  }
  return -1;
}
var detailCheck = [0,0,0,0,0,0];
var baseCost = 15000;
var dispCost = 0;

function setupBody(){
  setKindEvent();
//  addDetailData();
}

function setKindEvent(){
  kindData.forEach(kind=>{
    Evt(Id('kind_'+kind),'change',refleshDetailData);
  });
}

function addDetailData(){
  const div=Id('detailselector');
  let radVal=0;
  for (let i=0;i<Name('kind').length&&!Name('kind').item(i).checked;i++)
    radVal++;
  for (let i=0;i<detailData[radVal].length;i++) {
    add(
      add(
        div,
        cInput('type','radio','name','detail','value',i+radVal*10,'id','detail_'+i,'checked',detailCheck[radVal]==i,'event','change',setDetailCk)),
      add(
        add(
          cLabel('html','detail_'+i),
          cText(detailData[radVal][i].name)),
        add(
          cAbbr(),
          cText(getPriceText(detailData[radVal][i].price-detailData[radVal][detailCheck[radVal]].price,true))
        )
      )
    );
  }
}

function setPartsList() {
  for(let i=0;i<kindData.length;i++) {
    Id('part_'+kindData[i]).textContent=detailData[i][detailCheck[i]].name;
  }
  calcDispCost();
  Id('p_price').textContent=getPriceText(dispCost);
  refleshDetailData();
}

function calcDispCost(){
  dispCost=baseCost;
  for (let i=0;i<kindData.length;i++)
    dispCost+=detailData[i][detailCheck[i]].price;
}

function setDetailCk(){
  detailCheck[Math.floor(this.value/10)]=this.value%10;
  setPartsList();
}

function refleshDetailData(){
  const div=Id('detailselector');
  delChild(div);
  addDetailData();
};

window.onload=function() {
  setupBody();
}