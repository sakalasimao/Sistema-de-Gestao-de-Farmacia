$(document).ready(function(){

let sc = document.getElementById("pesquisa");
let qtd = document.getElementById("qtd");

 onScan.attachTo(document, {
suffixKeyCodes: [13], // enter-key expected at the end of a scan
reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)

onScan: function(sCode, iQty) { // Alternative to document.addEventListener('scan')
    console.log('Scanned:' + sCode); 
    var code = sCode;
    sc.value = sCode; 

    if(sc.value != ""){

        $.ajax({
            url: '../model/AcessarCarrinho.php',
            type: 'GET',
            data: {
                pesquisa: code
            },
            success: function(data){
               location.reload();
                $('#meg').html(data);
                //alert("OLLLÁ");
    
            },
            error: function(data){
                //$('#meg').html("PÁGINA INSERT NÃO ENCONTRADO!!");
            }
        });
    
        window.setTimeout(function() {
            sc.value = "";
        }, 2000);
    
    }

    
}

});





});