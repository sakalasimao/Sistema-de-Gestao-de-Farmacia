$(document).ready(function() {


    // PLUS QUANTITY
    $('body').on('click', '.plus', function(e){

        e.preventDefault();

        var form = $(this).attr('data-id');
        var val = $('.quantity').change().val();
        var url = "../model/quantity.php?plus="+form;

        console.log(form);

         $.ajax({

             url: url,
             type: 'POST',
             data: form,
             datatype: 'JSON',

             success: function(data){
                location.reload();
                 console.log('SUCESSO PLUS');
                 console.log(data);

             }
         });

    });

        // MINUS QUANTITY
        $('body').on('click', '.minus', function(e){

            e.preventDefault();
    
            var form = $(this).attr('data-id');
            var val = $('.quantity').change().val();
            var url = "../model/quantity.php?minus="+form;
          
    
            console.log(form);
    
            $.ajax({
    
                url: url,
                type: 'POST',
                data: form,
                datatype: 'JSON',
    
                success: function(data){
                    location.reload();
                    console.log('SUCESSO MINUS');
                    console.log(data);
    
                }
            });
    
        });


        // DISCONT
        $('body').on('click', '.descont', function(e){

            e.preventDefault();
    
            var form = $(this).attr('data-dc');
            var dc = $('#ds').val();
            var url = "../model/quantity.php?descont="+form;
          
    
            console.log(form);
    
            $.ajax({
    
                url: url,
                type: 'POST',
                data: {
                    desconto: dc
                },
                datatype: 'JSON',
    
                success: function(data){
                   // location.reload();
                    console.log('SUCESSO DISCONT');
                    console.log(data);
    
                }
            });
    
        });
    
    




});