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
  //setItemAreaDetail();
  onload = true;
  add(Id('arrow_left'),cText('<'));
  Evt(Id('arrow_left'),'click',()=>{
    animpart = 2;
    nowselect -1 >= 0 ? nowselect-- : nowselect = sldNum - 1;
    movest = true;
    timer = new Date();
    nowtimer = 0;
  });
  add(Id('arrow_right'),cText('>'));
  Evt(Id('arrow_right'),'click',()=>{
    animpart = 1;
    nowselect + 1 < sldNum ? nowselect++ : nowselect = 0;
    movest = true;
    timer = new Date();
    nowtimer = 0;
  });
  divSlider = Id('slider');
  sldList = divSlider.getElementsByTagName('li');
  sldNum = sldList.length;
  divPoints = Id('slider_point');
  for (let i=0;i<sldNum;i++) {
    add(
      divPoints,
      cInput('type','radio','name','slider_ptbtn','class','slider_ptbtn','id','slider_ptbtn'+i,'checked',i==0,'event','change',sliderMove),
      cLabel('html','slider_ptbtn'+i)
    );
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
          add(divSlider,remChild(divSlider,sldList[0]));
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
          add(divSlider,remChild(divSlider,sldList[0]));
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
            add(divSlider,remChild(divSlider,sldList[0]));
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