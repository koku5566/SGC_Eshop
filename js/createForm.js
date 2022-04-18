//to enable and disable option
var formElement = document.getElementById("formElementSelection");
var optionInput = document.getElementById("optionInput");
var completeBtn = document.getElementById("completeBtn");

formElement.addEventListener('click', enableOption);

function enableOption()
{
    if(formElement.value == "select")
    {
        optionInput.style.display = 'block';
    }
    else
    {
        optionInput.style.display = 'none';
    }
}

completeBtn.addEventListener('click', function(){
    window.location.href='./eventSellerDashboard.php';
})