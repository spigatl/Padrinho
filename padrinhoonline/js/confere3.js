function validateForm() {
        blnvalidate = true;
        var msg1 = "";
        var msg2 = "";
        var msg3 = "";
        var $inputs = $('#formElem').find('input');
        $inputs.each(function(i) {
            var valid = $(this).attr('id');
            var check = $(this).val();
            var check2 = $('#fr_resenha').val();
            var emailReg = /^.+@.+..{2,3}$/;
            if ((valid != 'fr_senha') & (valid != 'check') & (valid != 'fr_resenha')) {
                if ($.trim(check) == '') {
                    blnvalidate = false;
                    msg3 = "<p class='p_erro'><h12>Preencher os campos corretamente.</h12></p>";
                    $(this).css("background-color","#FFEDEF");
                } else {
                    $(this).css("background-color","#FFFFFF");
                }
            } else if (valid == 'fr_senha') {
                if (($.trim(check) == '') || ($.trim(check) != $.trim(check2))) {
                    blnvalidate = false;
                    msg2 = "<p class='p_erro'><h13>As senhas estão erradas ou nao conferem.</h13></p>";
                    $(this).css("background-color","#FFEDEF");
                    $('#fr_resenha').css("background-color","#FFEDEF");
                } else {
                    $(this).css("background-color","#FFFFFF");
                    $('#fr_resenha').css("background-color","#FFFFFF");
                }
            } else if (valid == 'check') {
                if ($(this).attr('checked') == false) {
                    blnvalidate = false;
                    msg1 = "<p class='p_erro'><h14>Marcar o Termo de Uso.</h14></p>";
                }
            }
        });
    $("html, body").animate({"scrollTop":"0"},'slow');
    $('#fr_error').html("<div id='fr_erro2'>" + msg1 + msg2 + msg3 + "</div>");
    return blnvalidate;
    }
//verificaçao do campos "Alterar Dados Pessoais" 
$(document).ready(function() {
    $("#formElem").submit(function() {
        if (!validateForm()) {
            return false;
        }
    });
});