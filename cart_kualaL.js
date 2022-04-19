var kltotal = 0;
var kldiscount = 0;
//count input + unitprice
// testing set a id for each item count class name
var count_input = document.getElementsByClassName('sub_kl')
    console.log(count_input)

var removeCartItemButtons = document.getElementsByClassName('removeItem_kl')
    console.log(removeCartItemButtons)

var discount_count = document.getElementById("discount_kl").innerText
    //console.log(parseFloat(discount_count) / 100.0)


// auto subtotal
calsubtotal(); 
//caldistotal();
//convertdecimal();

// function to count subtotal
function calsubtotal()
{
    kltotal = 0;
    
    var count_input2 = document.getElementsByClassName('count-input-kl')
    for (let index = 0; index < count_input2.length; index++) {

        document.getElementById('tpkl['+index+']').innerHTML = parseFloat(document.getElementById('numkl['+index+']').innerText) * parseFloat(document.getElementById('numberkl['+index+']').value);
        document.getElementById('subkl['+index+']').value = parseFloat(document.getElementById('numkl['+index+']').innerText) * parseFloat(document.getElementById('numberkl['+index+']').value);
        kltotal = kltotal + Number(document.getElementById('subkl['+index+']').value);
        //kltotal = kltotal + parseInt(document.getElementById('tpkl['+index+']').innerText);
    }

    
    document.getElementById('subtotal_kl').innerHTML = (Math.round((kltotal + Number.EPSILON) * 100) / 100).toFixed(2);
}

// function convertdecimal() 
// {
//     var percent = parseFloat(document.getElementById("discount_kl").innerText);
//     var result = percent / 100;
//     document.getElementById("txtDecimalResult").value= result;
//     console.log(result)
// }
function caldistotal()
{
    kldiscount = 0;
        
    kldiscount = kltotal - Number(document.getElementById('discount_kl').innerText);
    console.log("after discount: " + kldiscount)
    //document.getElementById('subtotal_kl').innerHTML = (Math.round((kldiscount + Number.EPSILON) * 100) / 100).toFixed(2);
}

// Use array to find the row index
const arr = new Array();

function useArray()
{
    kltotal = 0;
    kldiscount = 0;

    var count_input2 = document.getElementsByClassName('count-input-kl');
    for (let index = 0; index < count_input2.length; index++) {
        
        arr[index] = index;
    };

    console.log('arr length: ' + arr.length);
    for (let index = 0; index < arr.length; index++) {
        kltotal = kltotal + Number(document.getElementById('subkl['+arr[index]+']').value);
        kldiscount = kltotal - Number(document.getElementById('discount_kl').innerText);
        //kltotal = kltotal + parseInt(document.getElementById('tpkl['+arr[index]+']').innerText);
    }
    document.getElementById('subtotal_kl').innerHTML = (Math.round((kldiscount + Number.EPSILON) * 100) / 100).toFixed(2);
}

// function remove item
function removeint(x)
{
    kltotal =0;
    kldiscount = 0;

    for( var i = 0; i < arr.length; i++)
    { 
        
        if ( arr[i] == x) 
        { 
            arr.splice(i, 1); 
        }
        
    }

    if (arr.length == 0) {
        document.getElementById('discount').remove();
    }

    console.log("after remove arr length: " + arr.length);
    for (let index = 0; index < arr.length; index++) {
        kltotal = kltotal + Number(document.getElementById('subkl['+arr[index]+']').value);
        kldiscount = kltotal - Number(document.getElementById('discount_kl').innerText);
        //kltotal = kltotal + parseInt(document.getElementById('tpkl['+arr[index]+']').innerText);
    }

    //var positiveValue = kldiscount
    if (kldiscount >= 0) {
        var positiveValue = kldiscount;
    }
    else if( kldiscount < 0)
    {
        var positiveValue = 0;
    }

    document.getElementById('subtotal_kl').innerHTML = (Math.round((positiveValue + Number.EPSILON) * 100) / 100).toFixed(2);
    //useArray();
} 
//  for loop increment and decrement
useArray();



var tempe = 0;
for (var i = 0; i < count_input.length; i++) 
{
     
    console.log('loop: ' + i);

    //cart id
    const cart_id = parseInt(document.getElementById('cart_id['+i+']').value);
    console.log("CARTID: " + cart_id);

    //item counting
    var additembtn_kl = document.getElementById('addkl['+i+']');
    var countitembtn_kl = document.getElementById('numkl['+i+']');
    var minusitembtn_kl = document.getElementById('minkl['+i+']');
    
    // get each produt quanity 
    const numValuekl = parseInt(document.getElementById('numkl['+i+']').innerText);

    // product max available stock
    const maxProduct = parseInt(document.getElementById('stockl['+i+']').value)
    
    //catch unit price id
    var unitprice_kl = document.getElementById('numberkl['+i+']').value;

    //catch total price id
    var totalprice_kl = document.getElementById('subkl['+i+']');
    var textprice_kl = document.getElementById('tpkl['+i+']');            

    const additembtnt_kl = additembtn_kl,
    minusitembtnt_kl = minusitembtn_kl,
    countitembtnt_kl = countitembtn_kl,
    unitpricef_kl = unitprice_kl,
    totalpricef_kl = totalprice_kl,
    textpricef_kl = textprice_kl;

    let n = numValuekl;
    let max = maxProduct;
    let uniprice_kl = unitpricef_kl;
    let toprice_kl = n * uniprice_kl;

        // Increment count
        additembtnt_kl.addEventListener("click", ()=>{
            var subtotal = 0;

            if(n < max)
            {
                n++;
                countitembtnt_kl.innerHTML = n.toString();
                
                kltotal = kltotal - toprice_kl;

                //display price each item
                toprice_kl = n * unitpricef_kl;
                //toprice_kl = n * unitpricef_kl;
                //subtotal = subtotal + toprice;
                totalpricef_kl.value = (Math.round((toprice_kl + Number.EPSILON) * 100) / 100).toFixed(2);
                textpricef_kl.innerHTML = (Math.round((toprice_kl + Number.EPSILON) * 100) / 100).toFixed(2);
                
                //cal final sub total
                kltotal = kltotal + toprice_kl;

                //cal final total with discount
                kldiscount = kltotal - Number(document.getElementById('discount_kl').innerText);

                document.getElementById('subtotal_kl').innerHTML = (Math.round((kldiscount + Number.EPSILON) * 100) / 100).toFixed(2);
                calling();
                save_to_db(cart_id, n)
            }
            
        })

        // Decrement count
        minusitembtnt_kl.addEventListener("click", ()=>{
            var subtotal = 0;
            if(n > 1)
            {   
                n--;
                countitembtnt_kl.innerHTML = n.toString();
                
                kltotal = kltotal - toprice_kl;

                //display price each item
                toprice_kl = n * unitpricef_kl;
                //toprice_kl = n * unitpricef_kl;
                //subtotal = subtotal - toprice;
                totalpricef_kl.value = (Math.round((toprice_kl + Number.EPSILON) * 100) / 100).toFixed(2);
                textpricef_kl.innerHTML = (Math.round((toprice_kl + Number.EPSILON) * 100) / 100).toFixed(2);

              
                //cal final sub total
                kltotal = kltotal + toprice_kl;

                //cal final total with discount
                kldiscount = kltotal - Number(document.getElementById('discount_kl').innerText);
                
                document.getElementById('subtotal_kl').innerText = (Math.round((kldiscount + Number.EPSILON) * 100) / 100).toFixed(2);
                calling();
                save_to_db(cart_id, n)
            }
            
        })
    
    // Remove item
    // var button = removeCartItemButtons[i];
    // const temp = i; 
    // button.addEventListener('click', function(event)
    // {   
        
    //     var buttonClicked = event.target
    //     buttonClicked.parentElement.parentElement.remove()
    //     //delete amount from row
    //     document.getElementById('klform['+i+']').submit();
    //     console.log("remove row: " + temp);
    //     removeint(temp);
    //     calling();
        
    // }) 
}

function calling()
    {
        subtotal_tol = 0;

        subtotal_tol = subtotal_tol + parseFloat(document.getElementById("subtotal_kl").innerHTML) + parseFloat(document.getElementById("subtotal_sj").innerHTML);

        document.getElementById('subtotal_count').innerHTML = (Math.round((subtotal_tol + Number.EPSILON) * 100) / 100).toFixed(2);      
    }  
 