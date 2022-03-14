<?php
    require __DIR__ . '/header.php'
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">

    <!-- Page Heading -->
    <h1 style="padding: 0px;width: 314.6px;text-align: center;margin-left: 550px;color: rgb(162,30,30);">My Order</h1>
       
    </div><br>

    <!-- Content Row -->
    <div class="row">
<!-- Content Row -->
<div class="row">
      <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
      box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
      border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">ALL</button>
      <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
      box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
      border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">UNPAID</button>
      <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
      box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
      border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">TO SHIP</button>
      <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
      box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
      border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">SHIPPING</button>
      <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
      box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
      border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">COMPLETE</button>
      <button class="btn btn-primary" type="button" style="width: 189.3875px;height: 99px;margin: 0px;margin-left: 24px;color: var(--bs-blue);font-size: 19px;background: var(--bs-white);text-align: left;
      box-shadow: 2px 2px var(--bs-gray-200);padding-top: 0px;padding-bottom: 41px;
      border-style: solid;border-color: var(--bs-gray-200);border-radius: 4px;">RETURN/REFUND</button>
</div>
  <!----------------Back Button------------------->
<button class="btn btn-primary" type="button" style="width: 89.5px;padding-left: 6px;margin-left: 12px;background: rgba(13,110,253,0);color: var(--bs-blue);border-style: none;border-color: var(--bs-body-bg);text-decoration: underline;"><i class="fa fa-long-arrow-left" style="padding-right: 9px;color: var(--bs-blue);background: rgba(255,255,255,0);"></i>Back</button>
  <!---------------Search----------------------->  
   <h1 style="width: 354px;margin-left: 130px;margin-top: 20px;font-size: 25px;">Search OrderID</h1>
  <input type="search" id="searchID" onkeyup="myFunction()" style="margin-left: 130px;width: 1130px;height: 40px;" placeholder="Input" />
      <!---------------The Button---------------------->
  <button class="btn btn-primary" type="button" style="width: 104.5px;height: 45px;margin-left: 1020px;padding-right: 12px;margin-right: 15px;margin-top: 15px;color: var(--bs-gray-400);background: rgba(206,212,218,0);border: 2px solid var(--bs-gray-400);">RESET</button>
  <button class="btn btn-primary" type="button" style="width: 104.5px;height: 45px;margin-top: 15px;background: rgb(162,30,30);border-style: none;">SEARCH</button>   
<br>
<!--<script>
function myFunction(){
  var input
  input = document.value.getElementby("searchID");
  
  
}
</script>-->
<!-------------------The Product row-------------------------------->
<br>
<br>
<div style="height: 700px;width: 1096px;margin-left: 155px;border-width: 0px;border-style: solid;">
    <div style="height: 55px;border: 3px solid rgba(173,181,189,0.5);">
      <br>
  <span style="padding-left: 5px;font-size: 19px;font-weight: bold;width: 69px;">Product(s)</span>
  <span style="padding-left: 350px;font-size: 19px;font-weight: bold;width: 69px;">SKU</span>
  <span style="padding-left: 120px;font-size: 19px;font-weight: bold;width: 69px;">OrderID</span>
  <span style="padding-left: 120px;font-size: 19px;font-weight: bold;width: 69px;">Status</span>
  <span style="padding-left: 150px;font-size: 19px;font-weight: bold;width: 69px;">Action</span>
  </div>
</div>
<!-----------------Order Items---------------------------->

<!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>