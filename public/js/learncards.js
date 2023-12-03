let $ = (id) => {
    return document.getElementById(id);
}

/*let letarr = (class_name) => {
    return document.getElementsByClassName(class_name);
}

class CheckAnswer{
    constructor(cards_arr) {
        this.cards_arr = cards_arr;
    }

    handleArr(){
        /*this.cards_arr.forEach(element => {
            element.onclick =()=>{
                this.formsend(element);
            }
        });
        for(let i=0;i<this.cards_arr.length;i++){
            this.cards_arr[i].osubmit =()=>{
                
                this.formsend(this.cards_arr[i]);
                return false;
            }
        }
    }

    formsend(elem){
        let id_main=elem.getAttribute('id_main');
        console.log(id_main);
        let translation=elem.getAttribute('value');
        
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "{{route('learn.chec')}}");
        xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        const body = JSON.stringify({
            'id_main': id_main,
            'value': translation,
            
        });
        
        xhr.onload = () => {
        if (xhr.readyState == 4 && xhr.status == 201) {
            console.log(JSON.parse(xhr.responseText));
        } else {
            console.log(`Error: ${xhr.status}`);
        }
        };
        xhr.send(body);
    }

}

let elems=letarr('card_form');
//console.log(elems);
//alert(elems);
let handle=new CheckAnswer(elems);

handle.handleArr();*/