
<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">

    <!-- Page Heading -->
    <h1 style="padding: 0px;width: 314.6px;text-align: center;margin-left: 550px;color: rgb(162,30,30);">My Order</h1>
       
    </div><br>

    <!-- Content Row -->
    <div class="row">

      <!-- This is Seller Task (All)-->
        <div class="col-xl-2 col-md-2 mb-4" style="margin-left:5px">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                All</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- This is Seller Task (Unpaid)-->
        <div class="col-xl-2 col-md-2 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Unpaid</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Seller Task To Ship -->
        <div class="col-xl-2 col-md-2 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                To Ship</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping -->
        <div class="col-xl-2 col-md-2 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Shipping
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="col-xl-2 col-md-2 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Completed</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    

  <!-- Return/refund -->
        <div class="col-xl-2 col-md-2 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Return/ Refund</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
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

