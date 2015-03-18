$(function() {
    $('#upfile1').click(function(event) {
        $('#photoin').click();
    });
});
/* Start de toda bagaça*/
function validateForms() 
{
    var elementsForms;

    document.getElementById('fr_error').innerHTML =  "";
    if (!document.getElementsByTagName("formElem")) return false;
    elementsForms = document.getElementsByTagName("form");
    for (var intCounter = 0; intCounter < elementsForms.length; intCounter++)
    { 
        return validateForm(elementsForms[intCounter]);
    } 
}
/* Verifica se cada campo esta corretamente compreenchido*/
function validateForm() {

    var blnvalidate = true;
    var elementsInputs;
    var elementsInputs2;
    var elementsSelect = (document.formElem.fr_estado.value);
    var msg1;
    var msg2;
    var msg3;
    var msg4;
    var msg5;
    var msg6;
    var msg7;

    elementsInputs = document.getElementsByTagName('input');

    for (var intCounter = 0; intCounter < elementsInputs.length; intCounter++)
    {
        elementsInputs2 = elementsInputs[intCounter].id;
        if (elementsInputs[intCounter].id != "photoin" && elementsInputs[intCounter].id != "check" && elementsInputs[intCounter].id != "fr_comp" && elementsInputs[intCounter].id != "fr_email" && elementsInputs[intCounter].id != "fr_cpf" && elementsInputs[intCounter].id != "fr_data")
        {
            if (validateText(elementsInputs, intCounter) == true)
            {
                blnvalidate = false;
                document.getElementById(elementsInputs2).style.backgroundColor="#FFEDEF";
                msg1 = '<p class="p_erro"><h12>Preencha os campos corretamente.</h12></p>'; 
            }
            else 
            {
                document.getElementById(elementsInputs2).style.backgroundColor="#FFFFFF";
                msg1 = "";
            }       
        } 
        //verifica se o email esta correto//
        else if (elementsInputs[intCounter].id == "fr_email")
        {
            if (validateEmail(elementsInputs, intCounter) == true)
            {
                blnvalidate = false;
                document.getElementById(elementsInputs2).style.backgroundColor="#FFEDEF";
                msg2 = '<p class="p_erro"><h13>E-mail nao é valido.</h13></p>';  
            }
            else 
            {
                document.getElementById(elementsInputs2).style.backgroundColor="#FFFFFF";
                msg2 = "";
            }       
        }
        //verifica se o checkbox foi marcado//
        else if (elementsInputs[intCounter].id == "check")
        {
            if (elementsInputs[intCounter].checked == false)
            {
                blnvalidate = false;
                msg3 = '<p class="p_erro"><h11>Marcar o campo "Aceito os termos de Uso."</h11></p>';
            }
            else
            {
                msg3 = "";
            }
        }
        else if (elementsInputs[intCounter].id == "fr_data")
        {
                // pega os valores //
                var data = document.getElementById(elementsInputs2).value;
                
                //separa dia do mes e ano //
                ano = new Date();
                dat1 = data.substring(0,2); 
                dat2 = data.substring(3,5);
                dat3 = data.substring(6,10);
                dat4 = ano.getFullYear();

                if ((dat1 < 01) || (dat1 > 31) || (dat2 < 01 || dat2 > 12) || (dat4 > dat3))
                {
                    blnvalidate = false;
                    document.getElementById(elementsInputs2).style.backgroundColor="#FFEDEF";
                    msg7 = '<p class="p_erro"><h11>O campo DATA esta errado.</h11></p>';   
                }
                else 
                {
                    document.getElementById(elementsInputs2).style.backgroundColor="#FFFFFF";
                    msg7 = "";
                }        
        }
        else if (elementsInputs[intCounter].id == "fr_cpf")
        {
            var cpf = document.getElementById(elementsInputs2).value; 

            // obtendo cada número do cpf // 
            pos1 = cpf.substring(0,1); 
            pos2 = cpf.substring(1,2); 
            pos3 = cpf.substring(2,3); 
            pos4 = cpf.substring(3,4); 
            pos5 = cpf.substring(4,5); 
            pos6 = cpf.substring(5,6); 
            pos7 = cpf.substring(6,7); 
            pos8 = cpf.substring(7,8); 
            pos9 = cpf.substring(8,9); 
            pos10 = cpf.substring(9,10); 
            pos11 = cpf.substring(10,11);
            pos12 = cpf.substring(10,11);
            pos13 = cpf.substring(10,11);
            pos14 = cpf.substring(10,11); 

            // somando todos os números do cpf // 
            var soma = parseFloat(pos1) + parseFloat(pos2) + parseFloat(pos3) + parseFloat(pos5) + parseFloat(pos6) + parseFloat(pos7) + parseFloat(pos9) + parseFloat(pos10) + parseFloat(pos11) + parseFloat(pos13) + parseFloat(pos14); 

            // resto da soma dos números do cpf dividido por 11 // 
            total = soma % 11; 
            cpftotal = cpf.length;

            // faz verificações para definir validade do cpf // 
            if(total != 0 && cpftotal != 14 || cpf == 00000000000 || cpf == 11111111111 || cpf == 22222222222 || cpf == 33333333333 || cpf == 44444444444 || cpf == 55555555555 || cpf == 66666666666 || cpf == 77777777777 || cpf == 88888888888 || cpf == 99999999999) { 
                blnvalidate = false;
                document.getElementById(elementsInputs2).style.backgroundColor="#FFEDEF";
                msg6 = '<p class="p_erro"><h11>CPF invalido.</h11></p>';
            } else { 
                document.getElementById(elementsInputs2).style.backgroundColor="#FFFFFF";
                msg6 = ""; 
            } 
        }
        // verifica se o select estado foi selecionado //
        else if (elementsSelect == "all") 
        {
            blnvalidate = false;
            document.formElem.fr_estado.style.backgroundColor="#FFEDEF";
            msg4 = '<p class="p_erro"><h14>Selecione seu estado.</h14></p>';
        }
        else 
        {
            document.formElem.fr_estado.style.backgroundColor="#FFFFFF";
            msg4 = "";
        }

        }
        if ((document.getElementById('fr_senha').value.length == '5') && (document.getElementById('fr_cosenha').value.length == '5')) 
            {
            if (document.getElementById('fr_senha').value != document.getElementById('fr_cosenha').value || document.getElementById('fr_senha').value.trim() == "") 
                {   
                    blnvalidate = false;
                    document.formElem.fr_senha.style.backgroundColor="#FFEDEF";
                    document.formElem.fr_cosenha.style.backgroundColor="#FFEDEF";
                    msg5 = '<p class="p_erro"><h14>As senhas nao conferem.</h14></p>';
                }
                else 
                {
                    document.formElem.fr_senha.style.backgroundColor="#FFFFFF";
                    document.formElem.fr_cosenha.style.backgroundColor="#FFFFFF";
                    msg5 = "";
                }
            }
            else
            {
                blnvalidate = false;
                document.formElem.fr_senha.style.backgroundColor="#FFEDEF";
                document.formElem.fr_cosenha.style.backgroundColor="#FFEDEF";
                msg5 = '<p class="p_erro"><h14>As senhas devem ter no minimo 5 caracteres.</h14></p>';
            }

    $("html, body").animate({"scrollTop":"0"},'slow');
    document.getElementById('fr_error').innerHTML = "<div id='fr_erro2'>" + msg1 + msg2 + msg3 + msg4 + msg5 + msg6 + msg7 + "</div>";
    return blnvalidate;
}

/* Verifica o campo e-mail foi digitado correto*/
function validateEmail(elementsInputs, intCounter)
{
        var emailFilter=/^.+@.+\..{2,3}$/;
        if (!emailFilter.test(elementsInputs[intCounter].value)) 
        { 
            return true; 
        } 
}
/* Verifica o campos nao estão vazios*/
function validateText(elementsInputs, intCounter, strErrorMessage) {
        if (elementsInputs[intCounter].value.trim() == "") {
            return true;
        } 
}

/* Aplica o submit caso nao haja erro*/
function applyOnSubmitToForms()
{
    elementsForms = document.getElementsByTagName("form"); 
    for (var intCounter = 0; intCounter < elementsForms.length; intCounter++) 
    { 
        elementsForms[intCounter].onsubmit = function ()
        {
            if (!validateForms())
            {
                return false;
            }
        }
    } 
}

/*Carrega upload foto e carrega o preview*/
function readURL(input) {
    var arquivo = $('#photoin').val();
    var extensao = arquivo.substr(arquivo.lastIndexOf('.') + 1).toLowerCase();
    if ((extensao == "jpg") || (extensao == "jpeg")) {
        $('#photo')
            .attr('src', 'imagens/ajax-loader.gif')
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

/* trava o comando onload para que a pagina nao tenha uma nova leitura e os dados ser percam*/
function addLoadEvent(func) 
{
    var oldonload = window.onload;
    if (typeof window.onload != 'function') 
    {
        window.onload = func;
    } 
    else 
    {
        window.onload = function() 
        {
                oldonload();
                func();
        }
    }
}

addLoadEvent(applyOnSubmitToForms);