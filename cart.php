<?php
    require __DIR__ . '/header.php'
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
<div class="column"><a class="btn btn-outline-secondary" href="#"><i class="icon-arrow-left"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
    </svg>  Back</a></div>
    <!-- Shopping Cart-->
    <div class="table-responsive shopping-cart">
        <table class="table">
            <thead>
            <span class = "college logo"><img src="https://feneducation.com/wp-content/uploads/2021/06/segi-kl-logo-1-01-1-300x150.png" alt="Logo"><strong> | SEGI COLLEGE KUALA LUMPUR</strong</span>
                <tr>
                    <th>Product Name</th>
                    <th class="text-center">Variations</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Total Price</th>
                    <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Cart</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    for ($i=0; $i < 3; $i++) { 
                        $u = 43.30 + $i;
                        $j = number_format((float)$u, 2, '.', '');
                        echo "
                        <tr>
                            <td>
                                <div class='product-item'>
                                    <a class='product-thumb' href='#'><img src='https://www.sony.com.my/image/5d02da5df552836db894cead8a68f5f3?fmt=png-alpha&wid=330&hei=330' alt='Product'></a>
                                    <div class='product-info'>
                                        <h4 class='product-title'><a href='#'>Sony Headphone WH-1000XM4</a></h4><span><em>Size:</em>-</span><span><em>Color:</em>Black</span>
                                    </div>
                                </div>
                            </td>
                            <td class='text-center'>
                                <div class='variation-input'>
                                    <select class='form-control-variation'>
                                        <option>RED</option>
                                        <option>YELLOW</option>
                                        <option>GREEN</option>
                                        <option>BLACK</option>
                                        <option>WHITE</option> 
                                    </select>
                                </div>
                            </td>
                            <td class='text-center text-lg text-medium' class='price' id='up[$i]'>RM <span>$j</span> <input id='number[$i]' type='hidden' value='$j' readonly></td>
                            <td class='text-center'>
                                <div class='count-input'>
                                    <span class = 'minus' id='min[$i]'>-</span>
                                    <span class = 'num' id='num[$i]'>1</span>
                                    <span class = 'add' id='add[$i]'>+</span>
                                </div>
                            </td>
                            <td class='text-center text-lg text-medium' >RM <span id='tp[$i]'>$j</span><input id='sub[$i]' type='hidden' value='$j' readonly></td>
                            <td class='text-center'><button class='removeItem' type ='button'>X</button></td>
                        </tr>";
                    }
                ?>
                <!-- <tr>
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="https://www.sony.com.my/image/5d02da5df552836db894cead8a68f5f3?fmt=png-alpha&wid=330&hei=330" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#">Sony Headphone WH-1000XM4</a></h4><span><em>Size:</em>-</span><span><em>Color:</em>Black</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="variation-input">
                            <select class="form-control-variation">
                                <option>RED</option>
                                <option>YELLOW</option>
                                <option>GREEN</option>
                                <option>BLACK</option>
                                <option>WHITE</option> 
                            </select>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">RM43.90</td>
                    <td class="text-center">
                        <div class="count-input">
                            <span class = "minus">-</span>
                            <span class = "num">1</span>
                            <span class = "add">+</span>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">RM43.90</td>
                    <td class="text-center"><button class="removeItem" type ="button">X</button></td>
                </tr>
                <tr>
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="https://www.sony.com.my/image/fab5814371e81d00a50804376e74fee9?fmt=png-alpha&resMode=bisharp&wid=384" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#">Sony Speaker SRS-XB43</a></h4><span><em>Size:</em>-</span><span><em>Color:</em> Black</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="variation-input">
                            <select class="form-control-variation">
                                <option>RED</option>
                                <option selected="">YELLOW</option>
                                <option>GREEN</option>
                                <option>BLACK</option>
                                <option>WHITE</option> 
                            </select>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">RM24.89</td>
                    <td class="text-center">
                        <div class="count-input">
                            <span class = "minus">-</span>
                            <span class = "num">1</span>
                            <span class = "add">+</span>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">RM24.89</td>
                    <td class="text-center"><button class="removeItem" type ="button">X</button></td>
                </tr>
                <tr>
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="https://via.placeholder.com/220x180/9932CC/000000" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#">Cole Haan Crossbody</a></h4><span><em>Size:</em> -</span><span><em>Color:</em> Turquoise</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="variation-input">
                            <select class="form-control-variation">
                                <option>RED</option>
                                <option>YELLOW</option>
                                <option>GREEN</option>
                                <option>BLACK</option>
                                <option>WHITE</option> 
                            </select>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">RM200.00</td>
                    <td class="text-center">
                        <div class="count-input">
                            <span class = "minus">-</span>
                            <span class = "num">1</span>
                            <span class = "add">+</span>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">RM200.00</td>
                    <td class="text-center"><button class="removeItem" type ="button">X</button></td>
                </tr>-->
                <tr> 
                <th colspan="6"><img src="https://feneducation.com/wp-content/uploads/2021/06/segi-kl-logo-1-01-1-300x150.png" alt="Logo"><strong> | SEGI COLLEGE KUALA LUMPUR</strong></th> 
                    <!-- <th>Product Name</th>
                    <th class="text-center">Variations</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Total Price</th>
                    <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Cart</a></th> -->
                </tr> 
                <!-- <tr>
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="https://www.sony.com.my/image/5d02da5df552836db894cead8a68f5f3?fmt=png-alpha&wid=330&hei=330" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#">Sony Headphone WH-1000XM4</a></h4><span><em>Size:</em>-</span><span><em>Color:</em>Black</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="variation-input">
                            <select class="form-control-variation">
                                <option>RED</option>
                                <option>YELLOW</option>
                                <option>GREEN</option>
                                <option>BLACK</option>
                                <option>WHITE</option> 
                            </select>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">RM43.90</td>
                    <td class="text-center">
                        <div class="count-input">
                            <span class = "minus">-</span>
                            <span class = "num">1</span>
                            <span class = "add">+</span>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">RM43.90</td>
                    <td class="text-center"><button class="removeItem" type ="button">X</button></td>
                </tr>  -->
            </tbody>
        </table>
    </div>
    <div class="shopping-cart-footer">
        <div class="column">
       
                <!-- Select voucher Modal -->
                
                <?php
                    //require __DIR__ . '/voucherModal.php'
                ?>

                <!-- <input class="form-control form-control-sm" type="text" placeholder="Coupon code" required="">
                <button class="btn btn-outline-primary btn-sm" type="submit">Apply Coupon</button> -->
        </div>
    </div>
    <div class="shopping-cart-footer" >
        <div class="column text-lg" >Subtotal: RM <span class="text-medium" id="subtotal" >0</span><a class="btn btn-checkout" href="#">Checkout</a></div>
        <!-- <div class="column"><a class="btn btn-primary" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart" data-toast-message="is updated successfully!">Update Cart</a><a class="btn btn-success" href="#">Checkout</a></div> -->
    </div>
</div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
    body{margin-top:20px;}
select.form-control:not([size]):not([multiple]) {
    height: 44px;
}
select.form-control {
    padding-right: 38px;
    background-position: center right 17px;
    background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNv…9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
    background-repeat: no-repeat;
    background-size: 9px 9px;
}
.college-logo
{
    height: 50px;
    width: 50%;
    background-color: #374250;
}
.count-input
{
    height: 30px;
    min-width: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #A71337;
    border-radius: 12px;
    color: #fff;
}
.count-input span
{
    width: 100%;
    text-align: center;
    font-size: 20px;
    font-weight: 600;
    cursor: pointer;
}

.count-input span.num
{
    font-size: 18px;
    padding-left: 15px;
    padding-right: 15px;
    border-right: 2px solid rgba(0,0,0,0.2);
    border-left: 2px solid rgba(0,0,0,0.2);
}
.form-control:not(textarea) {
    height: 44px;
}

.form-control-variation {
    text-align: center;
    padding: 0 18px 3px;
    border: 1px solid #dbe2e8;
    border-radius: 22px;
    background-color: #fff;
    color: #606975;
    font-family: "Maven Pro",Helvetica,Arial,sans-serif;
    font-size: 14px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.form-control {
    padding: 0 18px 3px;
    border: 1px solid #dbe2e8;
    border-radius: 22px;
    background-color: #fff;
    color: #606975;
    font-family: "Maven Pro",Helvetica,Arial,sans-serif;
    font-size: 14px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.btn-checkout
{
    color: #fff;
    background-color: #A71337;
}
.removeItem
{
    font-weight: 1000;
    height: 26px;
    width: 26px;
    color: #fff;
    background-color: #A71337;
    border-radius: 100%;
    border-style: none;

}
.shopping-cart,
.wishlist-table,
.order-table {
    margin-bottom: 20px
}

.shopping-cart .table,
.wishlist-table .table,
.order-table .table {
    margin-bottom: 0
}

.shopping-cart .btn,
.wishlist-table .btn,
.order-table .btn {
    margin: 0
}

.shopping-cart>table>thead>tr>th,
.shopping-cart>table>thead>tr>td,
.shopping-cart>table>tbody>tr>th,
.shopping-cart>table>tbody>tr>td,
.wishlist-table>table>thead>tr>th,
.wishlist-table>table>thead>tr>td,
.wishlist-table>table>tbody>tr>th,
.wishlist-table>table>tbody>tr>td,
.order-table>table>thead>tr>th,
.order-table>table>thead>tr>td,
.order-table>table>tbody>tr>th,
.order-table>table>tbody>tr>td {
    vertical-align: middle !important
}

.shopping-cart>table thead th,
.wishlist-table>table thead th,
.order-table>table thead th {
    padding-top: 17px;
    padding-bottom: 17px;
    border-width: 1px
}

.shopping-cart .remove-from-cart,
.wishlist-table .remove-from-cart,
.order-table .remove-from-cart {
    display: inline-block;
    color: #ff5252;
    font-size: 18px;
    line-height: 1;
    text-decoration: none
}

.shopping-cart .count-input,
.wishlist-table .count-input,
.order-table .count-input {
    display: inline-block;
    width: 100%;
    width: 86px
}

.shopping-cart .product-item,
.wishlist-table .product-item,
.order-table .product-item {
    display: table;
    width: 100%;
    min-width: 150px;
    margin-top: 5px;
    margin-bottom: 3px
}

.shopping-cart .product-item .product-thumb,
.shopping-cart .product-item .product-info,
.wishlist-table .product-item .product-thumb,
.wishlist-table .product-item .product-info,
.order-table .product-item .product-thumb,
.order-table .product-item .product-info {
    display: table-cell;
    vertical-align: top
}

.shopping-cart .product-item .product-thumb,
.wishlist-table .product-item .product-thumb,
.order-table .product-item .product-thumb {
    width: 130px;
    padding-right: 20px
}

.shopping-cart .product-item .product-thumb>img,
.wishlist-table .product-item .product-thumb>img,
.order-table .product-item .product-thumb>img {
    display: block;
    width: 100%
}

@media screen and (max-width: 860px) {
    .shopping-cart .product-item .product-thumb,
    .wishlist-table .product-item .product-thumb,
    .order-table .product-item .product-thumb {
        display: none
    }
}

.shopping-cart .product-item .product-info span,
.wishlist-table .product-item .product-info span,
.order-table .product-item .product-info span {
    display: block;
    font-size: 13px
}

.shopping-cart .product-item .product-info span>em,
.wishlist-table .product-item .product-info span>em,
.order-table .product-item .product-info span>em {
    font-weight: 500;
    font-style: normal
}

.shopping-cart .product-item .product-title,
.wishlist-table .product-item .product-title,
.order-table .product-item .product-title {
    margin-bottom: 6px;
    padding-top: 5px;
    font-size: 16px;
    font-weight: 500
}

.shopping-cart .product-item .product-title>a,
.wishlist-table .product-item .product-title>a,
.order-table .product-item .product-title>a {
    transition: color .3s;
    color: #374250;
    line-height: 1.5;
    text-decoration: none
}

.shopping-cart .product-item .product-title>a:hover,
.wishlist-table .product-item .product-title>a:hover,
.order-table .product-item .product-title>a:hover {
    color: #0da9ef;
}

.shopping-cart .product-item .product-title small,
.wishlist-table .product-item .product-title small,
.order-table .product-item .product-title small {
    display: inline;
    margin-left: 6px;
    font-weight: 500
}

.wishlist-table .product-item .product-thumb {
    display: table-cell !important
}

@media screen and (max-width: 576px) {
    .wishlist-table .product-item .product-thumb {
        display: none !important
    }
}

.shopping-cart-footer {
    display: table;
    width: 100%;
    padding: 10px 0;
    border-top: 1px solid #e1e7ec
}

.shopping-cart-footer>.column {
    display: table-cell;
    padding: 5px 0;
    vertical-align: middle
}

.shopping-cart-footer>.column:last-child {
    text-align: right
}

.shopping-cart-footer>.column:last-child .btn {
    margin-right: 0;
    margin-left: 15px
}

@media (max-width: 768px) {
    .shopping-cart-footer>.column {
        display: block;
        width: 100%
    }
    .shopping-cart-footer>.column:last-child {
        text-align: center
    }
    .shopping-cart-footer>.column .btn {
        width: 100%;
        margin: 12px 0 !important
    }
}

.coupon-form .form-control {
    display: inline-block;
    width: 100%;
    max-width: 235px;
    margin-right: 12px;
}

.form-control-sm:not(textarea) {
    height: 36px;
}
</style>

<script>

    

        var total = 0;
   
        //count input + unitprice
        // testing set a id for each item count class name
        var count_input = document.getElementsByClassName('count-input')
            console.log(count_input)

        var removeCartItemButtons = document.getElementsByClassName('removeItem')
            console.log(removeCartItemButtons)

        // auto subtotal
        calsubtotal();    

    function calsubtotal()
    {
        total = 0;
        var count_input2 = document.getElementsByClassName('count-input')
        for (let index = 0; index < count_input2.length; index++) {
           
            total = total + Number(document.getElementById('sub['+index+']').value);
        }

        document.getElementById('subtotal').innerHTML = (Math.round((total + Number.EPSILON) * 100) / 100).toFixed(2);
    }
    //

        for (var i = 0; i < count_input.length; i++) {
             

            //item counting
            var additembtn = document.getElementById('add['+i+']');
            var countitembtn = document.getElementById('num['+i+']');
            var minusitembtn = document.getElementById('min['+i+']');
            
            //catch unit price id
            var unitprice = document.getElementById('number['+i+']').value;
            console.log(unitprice);
            //catch total price id
            var totalprice = document.getElementById('sub['+i+']');
            var textprice = document.getElementById('tp['+i+']');            

            const additembtnt = additembtn,
            minusitembtnt = minusitembtn,
            countitembtnt = countitembtn,
            unitpricef = unitprice,
            totalpricef = totalprice,
            textpricef = textprice;

            let n = 1;
            let uniprice = unitpricef;
            let toprice = uniprice;

            console.log(toprice);

           
                additembtnt.addEventListener("click", ()=>{
                    var subtotal = 0;
                    n++;
                    countitembtnt.innerHTML = n.toString();

                    total = total - toprice;

                    //display price each item
                    toprice = n * unitpricef;
                    //subtotal = subtotal + toprice;
                    totalpricef.value = (Math.round((toprice + Number.EPSILON) * 100) / 100).toFixed(2);
                    textpricef.innerHTML = (Math.round((toprice + Number.EPSILON) * 100) / 100).toFixed(2);

                    //cal final sub total
                    total = total + toprice;

                    document.getElementById('subtotal').innerHTML = (Math.round((total + Number.EPSILON) * 100) / 100).toFixed(2);
                })

                minusitembtnt.addEventListener("click", ()=>{
                    var subtotal = 0;
                    if(n > 1)
                    {
                        n--;
                        countitembtnt.innerHTML = n.toString();
                        
                        total = total - toprice;

                        //display price each item
                        toprice = n * unitpricef;
                        //subtotal = subtotal - toprice;
                        totalpricef.value = (Math.round((toprice + Number.EPSILON) * 100) / 100).toFixed(2);
                        textpricef.innerHTML = (Math.round((toprice + Number.EPSILON) * 100) / 100).toFixed(2);


                        //cal final sub total
                        total = total + toprice;


                        document.getElementById('subtotal').innerText = (Math.round((total + Number.EPSILON) * 100) / 100).toFixed(2);
                    }
                    
                })
            
            //remove item
            var button = removeCartItemButtons[i]
            button.addEventListener('click', function(event)
            {
                var buttonClicked = event.target
                buttonClicked.parentElement.parentElement.remove()
                //delete amount from row
                calsubtotal();
                document.getElementById('subtotal').innerHTML = subtotal.toFixed(2);
            })
            
            
        }

        // var removeCartItemButtons = document.getElementsByClassName('removeItem')
        //     console.log(removeCartItemButtons)

        // for (var i = 0; i < removeCartItemButtons.length; i++)
        // {
        //     var button = removeCartItemButtons[i]
        //     button.addEventListener('click', function(event)
        //     {
        //         var buttonClicked = event.target
        //         buttonClicked.parentElement.parentElement.remove()
        //     })
        // }
        
    </script>