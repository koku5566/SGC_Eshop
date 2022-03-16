//To check one day event checkbox
var onedayCheck = document.getElementById("oneDayEvent_check");
var endDate = document.getElementById("eEndDate");
var startDate = document.getElementById("eStartDate");


onedayCheck.addEventListener('change', EventDayChecker);
startDate.addEventListener('change', updateEndIfOne);


function EventDayChecker()
{
    if(onedayCheck.checked)
    {
        endDate.value = startDate.value;
        endDate.disabled = true;
    }
    else
    {
        endDate.disabled = false;
    }
}

function updateEndIfOne()
{
    if(onedayCheck.checked)
    {
        endDate.value = startDate.value;
        endDate.disabled = true;
    }
}


//----------------------------------------------

//venue check online
var onlineCheckBtn = document.getElementById("onlineCheck");
var locationOption = document.getElementById("optionLocation");

onlineCheckBtn.addEventListener('change', onlineLocation);

function onlineLocation()
{
    if(onlineCheckBtn.checked)
    {
        locationOption.value = "Online";
        locationOption.disabled = true;
    }
    else
    {
        locationOption.disabled = false;
    }
}

