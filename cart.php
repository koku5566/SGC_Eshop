<?php
    require __DIR__ . '/header.php';

    $userID = $_SESSION["userid"];

    //filter shop profile
    $sql_shop = "SELECT DISTINCT(cart.shop_id) AS shopID, shopProfile.shop_name as shop_name 
                FROM cart 
                JOIN shopProfile
                ON cart.shop_id = shopProfile.shop_id
                WHERE `user_ID` = '$userID' AND cart.remove_Product = '0'";
    $query_shop = mysqli_query($conn, $sql_shop);

?>

<link rel="stylesheet" href="../css/cart.css">
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
<div class="column"><button class="btn btn-back" type="submit" onclick="history.back()">BACK</button></div>
    <!-- Shopping Cart-->
    <div class="table-responsive shopping-cart">
        
        <table class="table" style="border: groove;">
            <thead>
            <!-- <span class = "college logo"><img src="https://feneducation.com/wp-content/uploads/2021/06/segi-kl-logo-1-01-1-300x150.png" alt="Logo"><strong class = "branch"> | SEGI COLLEGE KUALA LUMPUR</strong</span> -->
                <tr>
                    <th>Product Name</th>
                    <th class="text-center">Variations</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Total Price</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    //start loop each shop contain which product
                    while ($row = mysqli_fetch_array($query_shop)) {
                        $shop_id = $row['shopID'];
                        $shop_name = $row['shop_name'];

                        //total price for each shop
                        $total = 0;

                        //header for each shop 
                        echo "<tr >   
                            <td colspan='6'>SHOP NAME: $shop_name</td>
                            </tr>";

                        //select product from this shop
                        $sql ="SELECT product.product_name AS P_name, product.product_price AS P_price, cart.variation_id AS variation_id, 
                        cart.quantity AS P_quantity, product.product_variation AS P_variation, product.product_stock AS product_stock, 
                        product.product_cover_picture AS P_pic, cart.product_ID AS PID, product.product_status AS P_status, cart.cart_ID AS cart_id
                        FROM `cart`
                        JOIN `product`
                        ON product.product_id = cart.product_ID 
                        JOIN `shopProfile`
                        ON product.shop_id = shopProfile.shop_id
                        WHERE cart.user_ID = '$userID'
                        AND cart.shop_id = '$shop_id'
                        AND cart.remove_Product = '0'
                        ORDER BY cart.update_at DESC";

                        $queryKL = mysqli_query($conn, $sql);

                        while ($rowKL = mysqli_fetch_array($queryKL)) {

                            $product_stock = 0;
                            $product_price = 0;
                            $stock_message = "";
                            $cart_id = $rowKL['cart_id'];
                            $product_id = $rowKL['PID'];
                            $product_name = $rowKL['P_name'];
                            $product_image = $rowKL['P_pic'];
                            $product_quantity = $rowKL['P_quantity'];
                            $variation_message = "";
                            $showNotif = false;
    
                            //check product available
                            if ($rowKL['P_status'] == 'A') {
                                
                                $stock_message = "RM <span class='".$product_id."' id='tpkl[$i]'></span><input class='sub_kl' id='subkl[$i]' type='hidden' value='".$product_price."' readonly>";

                                if ($rowKL['variation_id'] == "" ) {
                                    $product_price = $rowKL['P_price'];
                                    $product_stock = $rowKL['product_stock'];
    
                                    $variation_message = "<option selected>No Variation</option>";
                                }
                                else if ($rowKL['variation_id'] != "") {
                                    
                                    $sql_get_variation_price = "SELECT * FROM `variation` WHERE `variation_id` = '".$rowKL['variation_id']."'";
                                    $query_get_variation_price = mysqli_query($conn, $sql_get_variation_price);
                                    while( $row = mysqli_fetch_assoc($query_get_variation_price))
                                    {
                                        $product_price = $row['product_price'];
                                        $product_stock = $row['product_stock'];
    
                                        if ($row['product_stock'] == 0) {
                                            $showNotif = true;
                                            $product_stock = 0;
                                            $product_price = 0;
    
                                            $stock_message = "";
                                            $stock_message = "OUT OF STOCK<span id='tpkl[$i]' hidden></span><input class='sub_kl' id='subkl[$i]' type='hidden' value='' readonly>";
                                        }
                                    }
    
                                    $sql_get_variation = "SELECT * FROM `variation` WHERE `product_id` = '$product_id'";
                                    $query_get_variation = mysqli_query($conn, $sql_get_variation);
                                    while( $row = mysqli_fetch_assoc($query_get_variation))
                                    {
    
                                        if ($row['variation_1_choice'] == "") {
                                            $variation_message ="<option value='".$row['variation_id']."' disabled selected>No Variation</option>";
                                        }
                                        else if ($row['variation_1_choice'] != "") {
            
                                            if ($row['variation_id'] == $rowKL['variation_id']) {
                                                $variation_message = $variation_message . "<option value='".$row['variation_id']."' selected>".$row['variation_1_name'].":".$row['variation_1_choice']." - ".$row['variation_2_name'].":".$row['variation_2_choice']."</option>";
                                            }
                                            else{
                                                $variation_message = $variation_message . "<option value='".$row['variation_id']."'>".$row['variation_1_name'].":".$row['variation_1_choice']." - ".$row['variation_2_name'].":".$row['variation_2_choice']."</option>";
                                            }
                                                    
                                        }
                                    }
    
                                }
    
                                
                                
                            }
                            else if ($rowKL['P_status'] != 'A') {
                                $showNotif = true;
                                $product_stock = 0;
                                $product_price = 0;
    
                                $stock_message = "OUT OF STOCK<span id='tpkl[$i]' hidden></span><input class='sub_kl' id='subkl[$i]' type='hidden' value='' readonly>";
                            }
    
                            echo "
                                <tr id='".$product_id."'>
                                    <td>
                                        <div class='product-item'>
                                            <a class='product-thumb' href='#'><img src='/img/product/$product_image' alt='Product'></a>
                                            <div class='product-info'>
                                                <label> Cart: ".$cart_id."</label><br>
                                                <label>".$product_id."</label>
                                                <h4 class='product-title'><a href='#'>".$product_name."</a></h4><span><em>Size:</em>-</span><span><em>Color:</em>Black</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class='text-center'>
                                        <div class='variation-input'>
                                            <select class='form-select' onchange='updateVariation(".$cart_id.")' id='updateVariation".$cart_id."'>";
    
                                            echo  $variation_message;
                                            //check product variation
                                                // <option>RED</option>
                                                // <option>YELLOW</option>
                                                // <option>GREEN</option>
                                                // <option>BLACK</option>
                                                // <option>WHITE</option> 
                             echo           "</select>
                                        </div>
                                    </td>
                                    <td class='text-center text-lg text-medium' class='price' id='upkl[$i]'>RM <span>".$product_price."</span> <input id='numberkl[$i]' type='hidden' value='".$product_price."' readonly></td>
                                    <td class='text-center'>
                                        <div class='count-input-kl'>
                                            <input id='stockl[$i]' type='hidden' value='".$product_stock."' readonly>
                                            <input id='cq[$i]' type='hidden' value='".$product_stock."' readonly>
                                            <span class = 'minus' id='minkl[$i]'>-</span>
                                            <span class = 'num' id='numkl[$i]'>".$product_quantity."</span> 
                                            <span class = 'add' id='addkl[$i]'>+</span>
                                        </div>
                                    </td>
                                    <td class='text-center text-lg text-medium' id='".$product_id."'>";
    
                            echo $stock_message; 
                        
                            if ($showNotif == true) {
                                require __DIR__ . '/notifyModal.php';
                            }
                      
                            echo "
                                    </td>
                                    <td class='text-center'>    
                                        <form action='cart_manage.php' method='POST'>
                                            <input type='hidden' id='cart_id[$i]' value='".$cart_id."' name='cartID' readonly>
                                            <button class='removeItem_kl' name='removeItemBtn' type='submit'>X</button>
                                        </form>
                                    </td>
                                </tr>";
                            $i++;

                            $product_total = $product_price * $product_quantity;
                            $total += $product_total;
                        //end looping product for each shop    
                        }

                        echo "<tr >  
                                <td colspan='4'>";
                    ?>
                    
                    <?php
                            //require __DIR__ .'/voucherModal.php'
                        ?>
                    <?php
                        echo"
                                </td>
                                <td colspan='2' style='text-align: right; font-weight: bold;' >Total: <span class = 'sbt' id='".$shop_id."'>".$total."</span></td>
                            </tr>";
                    // end of looping shop    
                    }
                    
                ?>
            </tbody>
        </table>
        <!-- <td class='text-center text-lg text-medium' >RM <span id='tpkl[$i]'>OUT OF STOCK</span><input class='sub_kl' id='subkl[$i]' type='hidden' value='".$rowKL['P_price']."' readonly></td> -->
            <!-- <div class="shopping-cart-footer">
                <div class="column">
                    <form class="coupon-form" method="post"> -->
                        <!-- Select voucher Modal -->
                        
                        <?php
                            require __DIR__ .'/voucherModal.php'
                        ?>
                    <!-- </form> -->
                        <!-- <input class="form-control form-control-sm" type="text" placeholder="Coupon code" required="">
                        <button class="btn btn-outline-primary btn-sm" type="submit">Apply Coupon</button> -->
                <!-- </div>
            </div> -->

            <div class="shopping-cart-discount-footer" >
                <div class="column text-lg" id="discount" style="font-weight: bold;">Voucher Discount: -RM<span class="text-medium" id="discount_kl" >0</span></div>
            </div>
            <div class="shopping-cart-footer" >
                <div class="column text-lg" style="font-weight: bold;">Total: RM <span class="text-medium" id="subtotal_kl" >0</span></div>
            </div>
    </div>
    <div class="shopping-cart-footer">
        <div class="column">
            <form class="coupon-form" method="post">        
                <!-- Select voucher Modal -->
                
                <?php
                    //require __DIR__ .'/voucherModal.php'
                ?>
            </form>
                <!-- <input class="form-control form-control-sm" type="text" placeholder="Coupon code" required="">
                <button class="btn btn-outline-primary btn-sm" type="submit">Apply Coupon</button> -->
        </div>
    </div>
    <div class="shopping-cart-footer" >
        <form class = "footer" action="cart_manage.php" method="POST">
            <div class="column text-lg" style="font-weight: bold;">Subtotal: RM <span class="text-medium" id="subtotal_count" >0</span>
                <input id="subtotal_count_hidden" type="hidden" readonly name="subtotal" value="">
                <button class="btn btn-checkout" type='submit'>Checkout</button>
             </div> 
        </form>
        <!-- <div class="column"><a class="btn btn-primary" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart" data-toast-message="is updated successfully!">Update Cart</a><a class="btn btn-success" href="#">Checkout</a></div> -->
    </div>
</div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<script src="cart_kualaL.js"></script>

<script>

    var subtotal_tol = 0;

    calling();
    discountAmount();

    function calling()
    {
        subtotal_tol = 0;

        var updateSub = document.getElementsByClassName('sbt');
        for(var i=0; i<updateSub.length;i++)
        {
            subtotal_tol += parseFloat(updateSub[i].innerText);
        }

        //subtotal_tol = subtotal_tol + parseFloat(document.getElementById("subtotal_kl").innerHTML) + parseFloat(document.getElementById("subtotal_sj").innerHTML);
        //subtotal_tol = parseFloat(document.getElementById("subtotal_kl").innerHTML);
        document.getElementById('subtotal_count_hidden').value = (Math.round((subtotal_tol + Number.EPSILON) * 100) / 100).toFixed(2);
        document.getElementById('subtotal_count').innerHTML = (Math.round((subtotal_tol + Number.EPSILON) * 100) / 100).toFixed(2);      
    } 

    function discountAmount()
    {
        var afterDiscount = parseFloat(document.getElementById('subtotal_kl').innerText);
        var beforeDiscount = parseFloat(document.getElementById('subtotal_count').innerText);

        var discountTotal = afterDiscount - beforeDiscount;
        document.getElementById('discount_kl').innerHTML = (Math.round((discountTotal + Number.EPSILON) * 100) / 100).toFixed(2);
    }
     

    function save_to_db(cart_id, quantity) {
       
        $.ajax({
            method: "POST",
            url: "cart_manage.php",
            data: { cart_id: cart_id, quantity: quantity }
        })
        .done(function( msg ) {
                window.location.href = window.location.origin + '/cart.php';
         });
    }

    //update product variation
    function updateVariation(cart_id)
    {
        var variation_id = parseInt($('#updateVariation'+cart_id).val());
        console.log(cart_id);
        console.log(parseInt(variation_id));

        $.ajax({
            method: "POST",
            url: "cart_manage.php",
            data: { cart_id2: cart_id, variation_id: variation_id }
        })
        .done(function( msg ) {
                window.location.href = window.location.origin + '/cart.php';
                //alert(msg);
         });

    }
</script>
