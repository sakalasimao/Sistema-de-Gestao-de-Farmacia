
var myvar = setInterval(calcCliente, 100);

function calcCliente(){

    var total = document.getElementById('total');
    var pag = document.getElementById('pag');
    //	var disc = document.getElementById('discount');
    //var valor = document.getElementById('value');
    var value_client = document.getElementById('value_client');
    var troco = document.getElementById('troco');

    //valor.value = total.value;

     //var percent = (total.value / 100) * disc.value;
    //	var resultado = total.value - percent;

    troco.value = value_client.value - total.value;

    if(pag.value == 2){ // TPA
      troco.value = 0;
    }

    if(pag.value == 3){ // TRANSF. BANCARIA
      troco.value = 0;
    }
    
    if(total.value == 0){
        troco.value = 0;
    }

      if (troco.value < 0) {
        troco.value = 0;
      }


 


}