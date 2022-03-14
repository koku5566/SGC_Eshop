<?php
    require_once __DIR__ . '/header.php'
?>
  <div class="container padding-bottom-3x mb-1">
    <!--Horizontal Order Tracking Status-->
    <div class="card mb-3">
      <div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-uppercase">Tracking Order No
          - </span><span class="text-medium">34VB5540K83</span></div>
      <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
        <div class="w-100 text-center py-1 px-2"><span class="text-medium">Shipped Via:</span>DHL</div>
        <div class="w-100 text-center py-1 px-2"><span class="text-medium">Status:</span> Processing Order</div>
        <div class="w-100 text-center py-1 px-2"><span class="text-medium">Expected Date:</span> SEP 09, 2017</div>
      </div>
      <div class="card-body">
        <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
          <div class="step completed">
            <div class="step-icon-wrap">
              <div class="step-icon pt-4"><i class="pe-7s-cart"></i></div>
            </div>
            <h5 class="step-title">Confirmed Order</h5>
          </div>
          <div class="step completed">
            <div class="step-icon-wrap">
              <div class="step-icon  pt-4"><i class="pe-7s-config"></i></div>
            </div>
            <h5 class="step-title">Processing Order</h5>
          </div>
          <div class="step">
            <div class="step-icon-wrap">
              <div class="step-icon pt-4"><i class="pe-7s-car"></i></div>
            </div>
            <h5 class="step-title">Product Dispatched</h5>
          </div>
          <div class="step">
            <div class="step-icon-wrap">
              <div class="step-icon  pt-4"><i class="pe-7s-home"></i></div>
            </div>
            <h5 class="step-title">Product Delivered</h5>
          </div>
        </div>
        <hr>
        <!--Delivery Details-->
        <div class="row">
          <strong>Delivery Details </strong>
        </div>
        <div class="row">
          <div id="recepient-name">Yee YingYing</div>（+60）1117795416<br>
          <div id="address">9-13-9， Sri Impian Apartment, Lengkok Angsana, 11500 Ayer Itam, Pulau Pinang </div>
        </div>
        <hr>
        <!--Shipping Progress table-->
        <table class="table"> 
          <thead>
            <tr>
              <th scope="col">Location</th>
              <th scope="col">Date</th>
              <th scope="col">Activity</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
            </tr>
            
          </tbody>
        </table>

      </div>
    </div>
    
    <!--Order Details-->
    <div class="card">
      <div class="card-header ">
        <h5 class="card-title">
          <div class="text-end text-secondary p-1"><small>Purchased Date & Time</small></div>
          <div class="row">
            <div class="col-8">
              <!--Shop Logo & Name-->
              <span><img src="https://www.w3schools.com/images/w3schools_green.jpg" alt="W3Schools.com" width="40" height="40"></span>
              <span><strong>| SEGi College Subang Jaya</strong></span> 
            </div>
            <div class="col-4 text-right">
              <!--Purchase Date and Time-->
              <div class="text-end pt-2">
                04 Sep 2021 | 04:45 p.m.
              </span> 
            </div>
          </div>
        </h5>
      </div>
      <div class="card-body">
        <!--Ordered Items-->
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td scope="row"><img src="https://www.w3schools.com/images/w3schools_green.jpg" alt="W3Schools.com"></td>
              <td>3-in-1 Power Bank with Phone Stand Model: WI-SP510</td>
              <td>Navy blue</td>
              <td>RM34.00</td>
              <td>x1</td>
              <td class="red-text">rm349.00</td>
            </tr>
            <tr>
              <td scope="row"><img src="https://www.w3schools.com/images/w3schools_green.jpg" alt="W3Schools.com"></td>
              <td>3-in-1 Powe</td>
              <td>Navy blue</td>
              <td>RM34.00</td>
              <td>x1</td>
              <td class="red-text">rm349.00</td>
            </tr>
          </tbody>
        </table>
        <hr>
        <div class="row">
          <!--Payment method & Status-->
          <div class="col-8">
            <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2">
              <div class="w-100 text-start"><span class="text-medium p-2"><strong> Payment Method:</strong></span><span class="iconify" data-icon="bi:credit-card" style="color: black; width: 30px;height:30px"></span><span class="p-2">Credit Card</span> </div>
              <div class="w-100 text-start"><span class="text-medium"><strong>Status:</strong></span> <span class="iconify" data-icon="carbon:delivery" style="color: black;"></span>Processing Order</div>
            </div>
          </div>
          <!--Ordered Item Price Amount Information-->
          <div class="col-4"> 
            <div class="row p-2"> <!-- Total Amount-->
              <div class="col"> 
                Total: 
              </div>
              <div class="col">
                RM715.00
              </div>
            </div>
            <div class="row p-2"> <!--Discounts-->
              <div class="col">
                Discounts:
              </div>
              <div class="col">
                -RM258.00
              </div>
            </div>
            <div class="row p-2"> <!-- Delivery Fees-->
              <div class="col">
                Delivery Fees:
              </div>
              <div class="col">
                RM8.60
              </div>
            </div>
            <div class="row p-2"> <!-- Ordered Total-->
              <div class="col">
                <h4>Ordered Total:</h4> <!--**to input quantity of items-->
              </div>
              <div class="col red-text">
                <h4>RM465.60</h4>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>





<?php
    require __DIR__ . '/footer.php'
?>