$("#ticketTypeList_tbl").on('click','.selectBtn',function(){
    // get the current row
    var currentRow=$(this).closest("tr"); 
    
    var tName=currentRow.find("td:eq(0)").text(); 
    var tCapacity=currentRow.find("td:eq(1)").text(); 
    var tSalesStart=currentRow.find("td:eq(2)").text(); 
    var tSalesEnd=currentRow.find("td:eq(3)").text(); 
    var tPrice=currentRow.find("td:eq(4)").text(); 
    var tID=currentRow.find("td:eq(5)").text(); 

    var ticketName = document.getElementById("editTicketName");
    var ticketID = document.getElementById("editTicketID");
    var capacity = document.getElementById("editCapacity");
    var price = document.getElementById("editPrice");
    var salesStart = document.getElementById("editSalesStart");
    var salesEnd = document.getElementById("editSalesEnd");
    var updateTID = document.getElementById("ticketIDHide");

    ticketName.value = tName;
    ticketID.value = tID;
    capacity.value = tCapacity;
    price.value = tPrice;
    salesStart.value = tSalesStart;
    salesEnd.value = tSalesEnd;
    updateTID.value = tID;


});

var nextBtn = document.getElementById("nextForm");

if(nextBtn!=null)
{
    nextBtn.addEventListener('click', function(){
        window.location.href='./createForm.php';
    });
}

var nextUpdateBtn = document.getElementById("nextUpdateForm");
if(nextUpdateBtn!=null)
{
    nextUpdateBtn.addEventListener('click', function(){
    window.location.href='./updateForm.php';
});
}
