function itemAreaDetailStruct(name,href,src) {
  this.object=add(add(add(cDiv('class','items'),
                          add(cH4(),
                              cText(name))),
                      add(cDiv('class','item_pic'),
                          add(cA('href',href),
                              cImg('src',src)))),
                  add(cButton('type','button'),
                      cText('商品を見る'))
  );
}
const itemAreaDetail=[
  new itemAreaDetailStruct('商品名','','../image/item_01.jpg'),
  new itemAreaDetailStruct('商品名','','../image/item_02.jpg'),
  new itemAreaDetailStruct('商品名','','../image/item_03.jpg')
];
function setItemAreaDetail() {
  const area=Id('item_area_detail');
  for(let i=0;i<itemAreaDetail.length;i++){
    area.appendChild(itemAreaDetail[i].object);
  }
}
let loop=function(f){
let h={};
let l=function(){f();
h.id=requestAnimationFrame(l);
}
h.id=requestAnimationFrame(l);
return h;
}
let it=loop(anim);
let sldList;
let sldNum = 0;
let onload = false;
let divSlider;
let divPoints;
window.onload = function() {
  setItemAreaDetail();
  onload = true;
  document.getElementById('arrow_left').appendChild(document.createTextNode('<'));
  document.getElementById('arrow_left').addEventListener('click',()=>{
    animpart = 2;
    nowselect -1 >= 0 ? nowselect-- : nowselect = sldNum - 1;
    movest = true;
    timer = new Date();
    nowtimer = 0;
  });
  document.getElementById('arrow_right').appendChild(document.createTextNode('>'));
  document.getElementById('arrow_right').addEventListener('click',()=>{
    animpart = 1;
    nowselect + 1 < sldNum ? nowselect++ : nowselect = 0;
    movest = true;
    timer = new Date();
    nowtimer = 0;
  });
  divSlider = document.getElementById('slider');
  sldList = divSlider.getElementsByTagName('li');
  sldNum = sldList.length;
  divPoints = document.getElementById('slider_point');
  for (let i=0;i<sldNum;i++) {
    let btn = document.createElement('input');
    btn.type="radio";
    btn.name="slider_ptbtn";
    btn.className="slider_ptbtn";
    btn.id="slider_ptbtn"+i;
    btn.checked=i==0;
    btn.addEventListener('change',sliderMove);
    divPoints.appendChild(btn);
    let lbl = document.createElement('label');
    lbl.setAttribute('for','slider_ptbtn'+i);
    divPoints.appendChild(lbl);
  }
  anim();
}
let stoptime = 3000;
let movetime = 500;
let timer = new Date();
let animpart = -1;
let nowselect = 0;
let nowtimer = 0;
let moveanim = false;
let checkNum = 0;
let movest = false;
function sliderMove() {
  checkNum = 0;
  for (let i=0;i<sldNum*2;i+=2) {
    if(divPoints.childNodes[i].checked)
      break;
    checkNum++;
  }
  checkNum = (checkNum - nowselect + sldNum) % sldNum;
  stoptime = 0;
  movetime = 500 / checkNum;
}
function anim() {
  if (onload) {
    switch(animpart) {
      case -1:
        for (let i=0;i<sldNum-2;i++) {
          const last = divSlider.removeChild(sldList[0]);
          divSlider.appendChild(last);
        }
        for (let i=0;i<sldNum-2;i++) {
          if (i < 2) {
            sldList[i].style.opacity=i/2;
          }
          else {
            sldList[i].style.opacity=(4-i)/2;
          }
        }
        timer = new Date();
        animpart++;
        break;
      case 0:
        for(let i=0;i<sldNum;i++) {
          sldList[i].style.right=75+'%';
        }
        if (new Date() - timer > stoptime) {
          timer = new Date();
          animpart++;
          nowselect<sldNum-1?nowselect++:nowselect=0;
          nowtimer=0;
          movest = true;
        }
        break;
      case 1:
        if (movest) {
          const last = divSlider.removeChild(sldList[0]);
          divSlider.appendChild(last);
          movest = false;
        }
        for(let i=0;i<6;i++) {
          if (checkNum==0){
            sldList[i].style.right=(25+50*Math.sin(nowtimer*Math.PI/2))+'%';
            if (i < 2) {
              sldList[i].style.opacity=(1+i-Math.sin(nowtimer*Math.PI/2))/2;
            }
            else {
              sldList[i].style.opacity=(3-i+Math.sin(nowtimer*Math.PI/2))/2;
            }
          }
          else {
            sldList[i].style.right=(25+50*nowtimer)+'%';
            if (i < 2) {
              sldList[i].style.opacity=(1+i-nowtimer)/2;
            }
            else {
              sldList[i].style.opacity=(3-i+nowtimer)/2;
            }
          }
        }
        if (new Date() - timer > movetime) {
          timer = new Date();
          animpart = 0;
          if (checkNum==0) {
            for (let i=0;i<sldNum*2;i+=2) {
              divPoints.childNodes[i].checked=i/2==nowselect;
            }
          }
          else {
            checkNum--;
            if (checkNum==0) {
              stoptime = 3000;
              movetime = 500;
            }
          }
        }
        else {
          nowtimer = (new Date() - timer) / movetime;
        }
        break;
      case 2:
        if (movest) {
          for (let i=0;i<sldNum-1;i++) {
            const last = divSlider.removeChild(sldList[0]);
            divSlider.appendChild(last);
          }
          movest = false;
        }
        for(let i=0;i<6;i++) {
          sldList[i].style.right=(125-50*Math.sin(nowtimer*Math.PI/2))+'%';
          if (i < 3) {
            sldList[i].style.opacity=(-1+i+Math.sin(nowtimer*Math.PI/2))/2;
          }
          else {
            sldList[i].style.opacity=(5-i-Math.sin(nowtimer*Math.PI/2))/2;
          }
        }
        if (new Date() - timer > movetime) {
          timer = new Date();
          animpart = 0;
          if (checkNum==0) {
            for (let i=0;i<sldNum*2;i+=2) {
              divPoints.childNodes[i].checked=i/2==nowselect;
            }
          }
          else {
            checkNum--;
            if (checkNum==0) {
              stoptime = 3000;
              movetime = 500;
            }
          }
        }
        else {
          nowtimer = (new Date() - timer) / movetime;
        }
        break;
    }
  }
}