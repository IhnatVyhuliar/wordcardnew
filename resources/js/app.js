import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let  $= function(id){
    return document.getElementById(id);
}



let keyUpp= function(elem){
    //alert(this);
    let key_txt= elem.value;
    //alert(key_txt);
    $("number_cards_in").value=key_txt;
    $("number_range").value=key_txt;
    //$("number_range").value=1;
}
    //alert($("number_cards_in"));

  let range=$("number_range");

  let number=$("number_cards_in");
  range.addEventListener("onchange",(e)=>{
    number.value=e.target.value;
  })
  number.addEventListener("onkeyup",(e)=>{
    range.value=e.target.value;
  })
  
