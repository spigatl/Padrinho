function validateForm() {
        blnvalidate = true;
        var msg1 = "";
        var msg3;
        var $inputs = $('#formElem').find('input');
        $inputs.each(function(i) {
            var valid = $(this).attr('id');
            var check = $(this).val();
            var emailReg = /^.+@.+..{2,3}$/;
            if ((valid != "fr_data")) {
                if ($.trim(check) == "") {
                    blnvalidate = false;
                    msg1 = "<p class='p_erro'><h12>Preencha os campos corretamente.</h12></p>";
                    $(this).css("background-color","#FFEDEF");
                } else {
                    $(this).css("background-color","#FFFFFF");
                }
            }
            else if (valid == "fr_data") {
                    var d = new Date();
                    var mes = check.substr(3,2);
                    var ano = check.substr(6,4);
                    var dia = check.substr(0,2);
                    var t = d.getFullYear();
                if ($.trim(check) == "") {
                    blnvalidate = false;
                    msg3 = "<p class='p_erro'><h13>A data esta incorreta.</h13></p>";
                    $(this).css("background-color","#FFEDEF");
                }
                else if ((mes > 12) && (dia > 31)) {
                    blnvalidate = false;
                    msg3 = "<p class='p_erro'><h13>A data esta incorreta.</h13></p>";
                    $(this).css("background-color","#FFEDEF");
                }
                else if ((mes == 02) && (dia > 29)) {
                    blnvalidate = false;
                    msg3 = "<p class='p_erro'><h13>A data esta incorreta.</h13></p>";
                    $(this).css("background-color","#FFEDEF");
                }
                else if ((mes == 04 || mes == 06 || mes == 09 || mes == 11) && (dia > 30)) {
                    blnvalidate = false;
                    msg3 = "<p class='p_erro'><h13>A data esta incorreta.</h13></p>";
                    $(this).css("background-color","#FFEDEF");
                }
                else if ((mes == 01 || mes == 03 || mes == 05 || mes == 07 || mes == 10 || mes == 12) && (dia > 31))  {
                    blnvalidate = false;
                    msg3 = "<p class='p_erro'><h13>A data esta incorreta.</h13></p>";
                    $(this).css("background-color","#FFEDEF");                    
                }
                else if (t > ano) {
                    blnvalidate = false;
                    msg3 = "<p class='p_erro'><h13>A data esta incorreta.</h13></p>";
                    $(this).css("background-color","#FFEDEF");  
                } else {
                    $(this).css("background-color","#FFFFFF");
                    msg3 = "";
                }
 
            }
        });
    $("html, body").animate({"scrollTop":"0"},'slow');
    $('#fr_error').html("<div id='fr_erro2'>" + msg1 + msg3 + "</div>");
    return blnvalidate;
}
//verificaçao do campos "Alterar Dados Pessoais" 
$(document).ready(function() {
    $("#formElem").submit(function() {
        if (!validateForm()) {
            return false;
        }
    });
    $("#formSenha").submit(function() {
        if (!Pass()) {
            return false;
        }
    });
    $('#upfile1').on('click', function(e){ 
        $('#photoin').click(); 
        return false; 
    });
});
//Faz a imagem abrir o input file

/*Carrega upload foto e carrega o preview*/
function readURL(input) {
    var arquivo = $('#photoin').val();
    var extensao = arquivo.substr(arquivo.lastIndexOf('.') + 1).toLowerCase();
    if ((extensao == "jpg") || (extensao == "jpeg")) {
        $('#photo')
            .attr('src', '../imagens/ajax-loader.gif')
            .width(280)
            .height(210);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
            reader.onload = function (e) {
                $('#photo')
                    .attr('src', e.target.result)
                    .width(280)
                    .height(210);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    else 
    {
        alert("Somente é aceito arquivo com extensao jpg/jpeg")
    }
}

// Verifica se as senhas estao corretaas
function Pass() {
    var msg1 = "";
    blnvalidate = true;
    var senha1 = $('#fr_senha').val();
    var senha2 = $('#fr_resenha').val();
    if (senha1 != senha2) {
        blnvalidate = false;
        msg1 = "<p class='p_erro'><h13>As senhas nao conferem.</h13></p>";
        $('#fr_senha').css("background-color","#FFEDEF");
        $('#fr_resenha').css("background-color","#FFEDEF");
    }
    $('#fr_error').html("<div id='fr_erro2'>" + msg1 + "</div>");
    return blnvalidate;
}