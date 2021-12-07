function Log(str){console.log(str)}
function Warn(str){console.warn(str)}
function Error(str){console.error(str)}
/**外部jsをjsから読み込む*/
function setScriptJs(path) {
  var script=document.createElement('script');
  script.src=path;
  document.head.appendChild(script);
}
/**外部cssをjsから読み込む*/
function setStyleCss(path) {
  let style=document.createElement('link');
  style.rel='stylesheet';
  style.href=path;
  document.head.appendChild(style);
}
/**document.getElementById(id)の省略形*/
function Id(id) {
  return document.getElementById(id);
}
/**document.getElementsByName(name)の省略形*/
function Name(name) {
  return document.getElementsByName(name);
}
/**document.createElement(type)の省略形*/
function cElement(type,ary) {
  const ret = document.createElement(type);
  return setNodeData(ret,ary);
}
function cA(...ary){return cElement('a',ary);}
function cAbbr(...ary){return cElement('abbr',ary);}
function cB(...ary){return cElement('b',ary)};
function cBr(...ary){return cElement('br',ary)};
function cButton(...ary){return cElement('button',ary)};
function cDiv(...ary){return cElement('div',ary)};
function cForm(...ary){return cElement('form',ary)};
function cH1(...ary){return cElement('h1',ary)};
function cH2(...ary){return cElement('h2',ary)};
function cH3(...ary){return cElement('h3',ary)};
function cH4(...ary){return cElement('h4',ary)};
function cH5(...ary){return cElement('h5',ary)};
function cH6(...ary){return cElement('h6',ary)};
function cHr(...ary){return cElement('hr',ary)};
function cI(...ary){return cElement('i',ary)};
function cInput(...ary){return cElement('input',ary)};
function cImg(...ary){return cElement('img',ary);}
function cLabel(...ary){return cElement('label',ary);}
function cLi(...ary){return cElement('li',ary);}
function cOption(...ary){return cElement('option',ary);}
function cP(...ary){return cElement('p',ary);}
function cSelect(...ary){return cElement('select',ary);}
function cSpan(...ary){return cElement('span',ary);}
function cSvg(...ary){return cElement('svg',ary);}
function cEText(...ary){return cElement('text',ary);}
function cUl(...ary){return cElement('ul',ary);}
/**document.createTextNodeの省略形*/
function cText(str){return document.createTextNode(str);}
/**parent.appendChild(child)の省略形　親要素を返す。*/
function add(parent,...childs){
  childs.forEach(child=>{
    parent.appendChild(child);
  });
  return parent;
}
function addBody(child) {
  return add(document.body,child);
}
function Evt(element,event,func) {
  element.addEventListener(event,func);
}
function delChild(parent) {
  while(parent.childNodes.length>0){
  remChild(parent,parent.lastChild);
  }
}
function remChild(parent,child) {
  parent.removeChild(child);
}

/**配列から、Node情報をセットする*/
function setNodeData(node,ary) {
  let m = Id('a');
  for (let i=0;i<ary.length;i++){
    switch(ary[i]){
case'action'      :node.action      =ary[++i];break;
case'alt'         :node.alt         =ary[++i];break;
case'aria-hidden' :node.ariaHidden  =ary[++i];break;
case'checked'     :node.checked     =ary[++i];break;
case'class'       :node.className   =ary[++i];break;
case'event'       :node.addEventListener(ary[++i],ary[++i]);break;
case'href'        :node.href        =ary[++i];break;
case'inhtml'      :node.innerHTML   =ary[++i];break;
case'html'        :node.htmlFor     =ary[++i];break;
case'id'          :node.id          =ary[++i];break;
case'method'      :node.method      =ary[++i];break;
case'name'        :node.name        =ary[++i];break;
case'placeholder' :node.placeholder =ary[++i];break;
case'style'       :node.style       =ary[++i];break;
case'styleadd'    :node.style      +=ary[++i];break;
case'src'         :node.src         =ary[++i];break;
case'text'        :node.text        =ary[++i];break;
case'type'        :node.type        =ary[++i];break;
case'value'       :node.value       =ary[++i];break;
case'viewBox'     :node.viewBox     =ary[++i];break;
default:Warn(ary[i]);node.setAttribute(ary[i],ary[++i],false);
}}return node;}


/**値段を渡すと、テキストにして返します*/
function getPriceText(d,f) {
  let s=''+d,l=s.length,r='',c,i=0;
  for (;i<l;i+=3) {
    c=l-i>3;r=s.substr(c?l-i-3:0,c?3:l-i)+(i==0?'':',')+r;
  }
  return d<0?'-¥'+r.substr(1):f&&d>0?'+¥'+r:'¥'+r;
}

/**カート操作ボタン追加*/
function addCartButton(iscart,code) {
  if (iscart)
    return add(
    cButton('type','button','class','button_delete','event','click',deleteCart.bind(code)),
    cText('カートから削除')
  );
  else 
    return add(
    cButton('type','button','class','button_addcart','event','click',addCart.bind(code)),
    cText('カートへ追加')
  );
}
/**カート操作*/
function addCart() {
  let req=new XMLHttpRequest();
  req.open('POST','connect/addSession.php',true);
  req.responseType='json';
  Evt(req,'load',()=>{
    Log(this.response);
  })
  let form=new FormData();
  form.append('base','cart');
  form.append('mode','add');
  form.append('code',this);
  req.send(form);
}
function deleteCart() {
  let req=new XMLHttpRequest();
  req.open('POST','connect/addSession.php',true);
  req.responseType='json';
  let form=new FormData();
  form.append('base','cart');
  form.append('mode','delete');
  form.append('code',this);
  req.send(form);
}
/**お気に入り操作*/
function fixFav() {
  let req=new XMLHttpRequest();
  req.open('POST','connect/addSession.php',true);
  req.responseType='json';
  req.addEventListener('load',function() {
    Log(this.response);
  });
  let form=new FormData();
  form.append('base','fav');
  form.append('code',this);
  req.send(form);
}
/**お気に入り操作ボタン追加*/
function addFavoButton(isfav,name) {
  if (isfav)
    return cInput('type','checkbox','class','check_favorite','id','check_favorite'+name,'checked','checked');
  else
    return cInput('type','checkbox','class','check_favorite','id','check_favorite'+name);
}

/**商品データの作成*/
class itemDataStruct{
  constructor(href,img,name,html,price,flg,flg2,item_code,os_id,cpu_id,ram_id,gpu_id,ssd_id,hdd_id,cart_id=-1) {
    this.href=href;
    this.img=img;
    this.name=name;
    this.html=html;
    this.price=Number(price);
    this.flg=flg;
    this.flg2=flg2;
    this.item_code=item_code;
    this.cart_code=this.flg?cart_id:item_code;
    this.os_id=os_id;
    this.cpu_id=cpu_id;
    this.ram_id=ram_id;
    this.gpu_id=gpu_id;
    this.ssd_id=ssd_id;
    this.hdd_id=hdd_id;
    this.object=
    add(
      cDiv('class','item'),
      add(
        cDiv('class','item_img'),
        add(
          cA('href',this.href),
          cImg('src',this.img,'event','error',recoverImg)
        )
      ),
      add(
        cDiv('class','item_noimage'),
        add(
          cDiv('class','item_name'),
          cText(this.name)
        ),
        add(
          cDiv('class','item_desc'),
          cUl('inhtml',this.html)
        ),
        add(
          cDiv('class','item_price','id','item_price'),
          cText(getPriceText(this.price)+'(税込)'+(!this.flg?'～':''))
        ),
        add(
          cDiv('class','item_button'),
          add(
            cForm('method','post','action','customize.php'),
            cInput('name','item_code','value',this.item_code,'style','display:none'),
            cInput('name','os_id','value',this.os_id,'style','display:none'),
            cInput('name','cpu_id','value',this.cpu_id,'style','display:none'),
            cInput('name','memory_id','value',this.ram_id,'style','display:none'),
            cInput('name','gpu_id','value',this.gpu_id,'style','display:none'),
            cInput('name','ssd_id','value',this.ssd_id,'style','display:none'),
            cInput('name','hdd_id','value',this.hdd_id,'style','display:none'),
            add(
              cButton('type','submit','class','button_itemdetail'),
              cText('商品詳細へ')
            )
          ),
          addCartButton(this.flg,this.cart_code),
          addFavoButton(this.flg2,this.name),
          add(
            cLabel('class','button_favorite','html','check_favorite'+this.name,'event','click',
            fixFav.bind(this.item_code),'style',islogin?'':'display:none;'),
            cI('class','fas fa-heart','style',islogin?'':'display:none;')
          )
        )
      )
    );
  }
}

/**商品画像が存在しない/読み込めなかった場合*/
function recoverImg() {
  this.src='../image/NoImage.png';
}

/**データベースからデータを取得します。
 * SQLをJSで生成するのはあまりよろしくない(?)ので、
 * php側に処理を任せる。
*/
function getDbResponse(evt,...args) {
  let req=new XMLHttpRequest();
  req.open('POST','connect/getJson.php',true);
  req.responseType='json';
  req.addEventListener('load',evt);
  let form=new FormData();
  for(let i=0;i<args.length;i++){
    form.append(args[i],args[++i]);
  }
  req.send(form);
}
function getDbResponseArray(evt,args) {
  let req=new XMLHttpRequest();
  req.open('POST','connect/getJson.php',true);
  req.responseType='json';
  req.addEventListener('load',evt);
  let form=new FormData();
  for(let i=0;i<args.length;i++){
    form.append(args[i],args[++i]);
  }
  req.send(form);
}

function dispResponse() {
  Log(this.response);
}