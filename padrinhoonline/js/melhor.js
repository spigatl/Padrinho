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
	var elementsSelect =(formElem.fr_estado.value);

	elementsInputs = document.getElementsByTagName('input');

 	for (var intCounter = 0; intCounter < elementsInputs.length; intCounter++)
    {
    	elementsInputs2 = elementsInputs[intCounter].id;
        if (elementsInputs[intCounter].id != "photoin" && elementsInputs[intCounter].id != "check" && elementsInputs[intCounter].id != "fr_comp" && elementsInputs[intCounter].id != "fr_email")
        {
        	if (validateText(elementsInputs, intCounter) == true)
            {
              	blnvalidate = false;
               	document.getElementById(elementsInputs2).style.backgroundColor="#FFEDEF";   
            }
            else 
       		{
        		document.getElementById(elementsInputs2).style.backgroundColor="#FFFFFF";
       		}		
        } 
        else if (elementsInputs[intCounter].id == "fr_email")
        {
        	if (validateEmail(elementsInputs, intCounter) == true)
            {
              	blnvalidate = false;
               	document.getElementById(elementsInputs2).style.backgroundColor="#FFEDEF";  
           	}
           	else 
       		{
        		document.getElementById(elementsInputs2).style.backgroundColor="#FFFFFF";
       		}		
        }
        else if (elementsInputs[intCounter].id == "check")
        {
            if (elementsInputs[intCounter].checked == false)
            {
                blnvalidate = false;
                document.getElementById('fr_error').innerHTML = '<p class="p_erro"><h11>Por favor, marcar o campo "Aceito os termos de Uso."</h11></p>';
            }
        }
        else if (elementsSelect == "all") 
        {
        	formElem.fr_estado.style.backgroundColor="#FFEDEF";  
        }
        else 
        {
        	formElem.fr_estado.style.backgroundColor="#FFFFFF";
        }
	}
    $("body").animate({"scrollTop":"0"},500);
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
        if (elementsInputs[intCounter].value == "") {
            return true;
        } 
}
/* Aplica o submit caso na haja erro*/
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