function validateForm() {
    blnvalidate = true;
    var msg1 = "";
    var $inputs = $('#formElem').find('input');
    $inputs.each(function(i) {
        var valid = $(this).attr('id');
        var check = $(this).val();
        var num = check.replace(/[.\-\/]/g,"").length;
        if (valid == 'fr_cpf') {
            if (num == 11) {
                if (validaCpf(check) == true) {
                   blnvalidate = false;
                   $(this).css("background-color","#FFEDEF");
                   msg1 = '<p class="p_erro"><h11>CPF invalido.</h11></p>';
                }
            } else if (num == 14) {
                if (validaCnpj(check) == true) {
                   blnvalidate = false;
                   $(this).css("background-color","#FFEDEF");
                   msg1 = '<p class="p_erro"><h11>CNPJ invalido.</h11></p>';
                }
            } else {
                blnvalidate = false;
                   $(this).css("background-color","#FFEDEF");
                   msg1 = '<p class="p_erro"><h11>Preencha os campos corretamente.</h11></p>';
            }
        }
    });
    $("html, body").animate({"scrollTop":"0"},'slow');
    $('#fr_error').html("<div id='fr_erro2'>" + msg1 + "</div>");
    return blnvalidate;
}
// validar CNPJ
function validaCnpj(cnpj){
    /*remove ".", "-" e "/" utilizando expressão regular, assim
    * permite validar cnpj com ou sem pontos, barra e traço.*/
    cnpj = cnpj.replace(/[.\-\/]/g,"");
    if(cnpj.length != 14)
        return false;
    var id = new Array('00000000000000', 
              '11111111111111', 
              '22222222222222', 
              '33333333333333',
              '44444444444444',
              '55555555555555',
              '66666666666666',
              '77777777777777',
              '88888888888888',
              '99999999999999',
              '00000000000000');

    for (i=0; i < id.length; i++) {
        if (id[i] == cnpj) {
            return true;
        }
    }
    var dv = cnpj.substr(cnpj.length-2,cnpj.length);
    cnpj = cnpj.substr(0,12);
    /*calcular 1º dígito verificador*/
    var soma;
    soma = cnpj[0]*6;
    soma += cnpj[1]*7;
    soma += cnpj[2]*8;
    soma += cnpj[3]*9;
    soma += cnpj[4]*2;
    soma += cnpj[5]*3;
    soma += cnpj[6]*4;
    soma += cnpj[7]*5;
    soma += cnpj[8]*6;
    soma += cnpj[9]*7;
    soma += cnpj[10]*8;
    soma += cnpj[11]*9;
    var dv1 = soma%11;
    if (dv1 == 10) {
        dv1 = 0;
    }
    /*calcular 2º dígito verificador*/
    soma = cnpj[0]*5;
    soma += cnpj[1]*6;
    soma += cnpj[2]*7;
    soma += cnpj[3]*8;
    soma += cnpj[4]*9;
    soma += cnpj[5]*2;
    soma += cnpj[6]*3;
    soma += cnpj[7]*4;
    soma += cnpj[8]*5;
    soma += cnpj[9]*6;
    soma += cnpj[10]*7;
    soma += cnpj[11]*8;
    soma += dv1*9;
    var dv2 = soma%11;
    if (dv2 == 10) {
        dv2 = 0;
    }
    var digito = dv1+""+dv2;
    if(dv == digito){ /*compara o dv digitado ao dv calculado*/
        return true;
    }else{
        return false;
    }
}

// Validando CPF
function validaCpf(cpf){
    /*remove pontos e traço do cpf utilizando expressão regular,
    *permite validar cpf com ou sem pontos e traço*/
    cpf = cpf.replace(/[.\-]/g,"");
    if(cpf.length != 11)
        return false;
    var dv = cpf.substr(cpf.length-2,cpf.length);
    cpf = cpf.substr(0,9);
    /*calcular 1º dv*/
    var soma = 0;
    for(var i = 0;i < 9; i++){
        soma += cpf[i]*(i+1);
    }
    var dv1 = soma%11;
    /*calcular 2º dv*/
    soma = 0;
    for(var i = 0; i < 9; i++){
        soma += cpf[i]*i;
    }
    soma += dv1*9;
    var dv2 = soma%11;
    var digito = dv1+""+dv2;
    if(dv == digito){ /*compara o dv digitado ao dv calculado*/
        return true;
    }else{
        return false;
    }
}

//verificaçao do campos "Alterar Dados Pessoais" 
$(document).ready(function() {
    $("#formElem").submit(function() {
        if (!validateForm()) {
            return false;
        }
    });
});
//Faz a imagem abrir o input file
$(function() {
    $('#upfile1').click(function(event) {
        $('#photoin').click();
    });
});

function readURL2() {
    var img =  $('#ex04').is(":checked"); // retorna true ou false
    if (img == true) {
        return 28;
    } else {
        return 98;
    }
}

/*Carrega upload foto e carrega o preview*/
function readURL(input) {
    var arquivo = $('#photoin').val();
    var extensao = arquivo.substr(arquivo.lastIndexOf('.') + 1).toLowerCase();
    if ((extensao == "jpg") || (extensao == "jpeg")) {
        $('#photo')
            .attr('src', '../imagens/ajax-loader.gif')
            .width(98)
            .height(readURL2);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
            reader.onload = function (e) {
                $('#photo')
                    .attr('src', e.target.result)
                    .width(98)
                    .height(readURL2);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    else 
    {
        alert("Somente é aceito arquivo com extensao jpg/jpeg")
    }
}

$(document).ready(function (){
        $("#ex04:checkbox").iButton({
            change: function ($input) {
                $input.is(":checked") ? $('#photo').css('height', '28px') : $('#photo').css('height', '98px');
            }
        });
        
    });