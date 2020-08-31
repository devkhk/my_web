const btn1 = document.querySelector("#btn1"),
      btn2= document.querySelector("#btn2"),
      btn3 = document.querySelector("#btn3"),
      btn4= document.querySelector("#btn4");


console.log(btn1);

const CLICKED_CLASS = "mouseEnter";

function init(){
    btn1.addEventListener("mouseenter",handleClick1);
    btn1.addEventListener("mouseleave",handleClick1);
    btn2.addEventListener("mouseenter",handleClick2);
    btn2.addEventListener("mouseleave",handleClick2);
    btn3.addEventListener("mouseenter",handleClick3);
    btn3.addEventListener("mouseleave",handleClick3);
    btn4.addEventListener("mouseenter",handleClick4);
    btn4.addEventListener("mouseleave",handleClick4);
}


function handleClick1(){
  btn1.classList.toggle(CLICKED_CLASS);
}

function handleClick2(){
  btn2.classList.toggle(CLICKED_CLASS);
}

function handleClick3(){
  btn3.classList.toggle(CLICKED_CLASS);
}

function handleClick4(){
  btn4.classList.toggle(CLICKED_CLASS);
}


init();



// btn.forEach(function(item,index){
//   btn[index].addEventListener("mouseenter",handleClick);
//   // btn[index].addEventListener("mouseleave",handleClick(index));
// });
