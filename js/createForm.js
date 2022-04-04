//to enable and disable option
var editFormElement = document.getElementById("editFormElementSelection");
var editOptionInput = document.getElementById("editOptionInput");
var updateFormElement = document.getElementById("updateFormElementSelection");
var updateOptionInput = document.getElementById("updateOptionInput");
var formElement = document.getElementById("formElementSelection");
var optionInput = document.getElementById("optionInput");

formElement.addEventListener('click', enableOption);
editFormElement.addEventListener('click', enableOption);
updateFormElement.addEventListener('click', enableOption);

function enableOption()
{
    if(formElement.value == "select" || editFormElement.value == "select" || updateFormElement.value == "select")
    {
        optionInput.style.display = 'block';
    }
    else
    {
        optionInput.style.display = 'none';
    }
}
