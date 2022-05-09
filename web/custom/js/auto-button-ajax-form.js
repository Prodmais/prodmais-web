// verifica todo segundo se tem erro na pagina entao esconde o botao
$(document).ready(function() {

    initializeTimeStamp();
    
    function initializeTimeStamp() {

        setTimeout(function(){

            var number = document.querySelector('.has-error');
            if (number !== null) { // tenho error
               $('#div-loader-ajax').hide();
               $('#div-button-submit').show();

               // $('#botao-ajax').prop("disabled",true);
            } else {
                // $('#botao-ajax').prop("disabled",false);
            }

            // desabilitaBotaoForm();
            initializeTimeStamp();
        }, 500);

    }
});

// Exibe o botao loader depois de clicar no submit
$(document).ready(function() {
    $('form').on('submit', function(e) {
        $('#div-button-submit').hide();
        $('#div-loader-ajax').show();
    });
});
