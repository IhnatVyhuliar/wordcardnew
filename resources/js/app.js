import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let  $= function(id){
    return document.getElementById(id);
}



