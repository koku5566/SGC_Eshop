var sjtotal = 0;
    
// testing set a id for each item count class name
var count_input = document.getElementsByClassName('sub_sj')
    console.log(count_input)

var removeCartItemButtons = document.getElementsByClassName('removeItem_sj')
    console.log(removeCartItemButtons)

// auto subtotal
calsubTotal(); 
    
// function to count subtotal
function calsubTotal()
{
sjtotal = 0;
var count_input3 = document.getElementsByClassName('count-input-sj')
for (let index = 0; index < count_input3.length; index++) {
    
    sjtotal = sjtotal + Number(document.getElementById('subsj['+index+']').value);
}

document.getElementById('subtotal_sj').innerHTML = (Math.round((sjtotal + Number.EPSILON) * 100) / 100).toFixed(2);
}

// Use array to find the row index
const Arr = new Array();
function usearray()
{
sjtotal = 0;

var count_input3 = document.getElementsByClassName('count-input-sj');
for (let index = 0; index < count_input3.length; index++) {
    
    Arr[index] = index;
};

console.log('arr length: ' + Arr.length);
for (let index = 0; index < Arr.length; index++) {
    sjtotal = sjtotal + Number(document.getElementById('subsj['+Arr[index]+']').value);
}
document.getElementById('subtotal_sj').innerHTML = (Math.round((sjtotal + Number.EPSILON) * 100) / 100).toFixed(2);
}

// function remove item
function removeInt(x)
{
sjtotal =0;
for( var i = 0; i < Arr.length; i++)
{ 
    
    if ( Arr[i] == x) 
    { 
    
        Arr.splice(i, 1); 
    }
    
}

console.log("after remove arr length: " + Arr.length);
for (let index = 0; index < Arr.length; index++) {
    sjtotal = sjtotal + Number(document.getElementById('subsj['+Arr[index]+']').value);
}
document.getElementById('subtotal_sj').innerHTML = (Math.round((sjtotal + Number.EPSILON) * 100) / 100).toFixed(2);
//useArray();
}
//  for loop increment and decrement
usearray();
for (var i = 0; i < count_input.length; i++) {
        
    console.log('loop: ' + i);

    //item counting
    var additembtn_sj = document.getElementById('addsj['+i+']');
    var countitembtn_sj = document.getElementById('numsj['+i+']');
    var minusitembtn_sj = document.getElementById('minsj['+i+']');
    
    //catch unit price id
    var unitprice_sj = document.getElementById('numbersj['+i+']').value;
    
    //catch total price id
    var totalprice_sj = document.getElementById('subsj['+i+']');
    var textprice_sj = document.getElementById('tpsj['+i+']');            

    const additembtnt_sj = additembtn_sj,
    minusitembtnt_sj = minusitembtn_sj,
    countitembtnt_sj = countitembtn_sj,
    unitpricef_sj = unitprice_sj,
    totalpricef_sj = totalprice_sj,
    textpricef_sj = textprice_sj;

    let n = 1;
    let uniprice_sj = unitpricef_sj;
    let toprice_sj = uniprice_sj;


        // Increment count
        additembtnt_sj.addEventListener("click", ()=>{
            var subtotal = 0;
            n++;
            countitembtnt_sj.innerHTML = n.toString();

            sjtotal = sjtotal - toprice_sj;

            //display price each item
            toprice_sj = n * unitpricef_sj;
            //subtotal = subtotal + toprice;
            totalpricef_sj.value = (Math.round((toprice_sj + Number.EPSILON) * 100) / 100).toFixed(2);
            textpricef_sj.innerHTML = (Math.round((toprice_sj + Number.EPSILON) * 100) / 100).toFixed(2);

            //cal final sub total
            sjtotal = sjtotal + toprice_sj;

            document.getElementById('subtotal_sj').innerHTML = (Math.round((sjtotal + Number.EPSILON) * 100) / 100).toFixed(2);
            calling();
        })

        // Decrement count
        minusitembtnt_sj.addEventListener("click", ()=>{
            var subtotal = 0;
            if(n > 1)
            {
                n--;
                countitembtnt_sj.innerHTML = n.toString();
                
                sjtotal = sjtotal - toprice_sj;

                //display price each item
                toprice_sj = n * unitpricef_sj;
                //subtotal = subtotal - toprice;
                totalpricef_sj.value = (Math.round((toprice_sj + Number.EPSILON) * 100) / 100).toFixed(2);
                textpricef_sj.innerHTML = (Math.round((toprice_sj + Number.EPSILON) * 100) / 100).toFixed(2);


                //cal final sub total
                sjtotal = sjtotal + toprice_sj;

                document.getElementById('subtotal_sj').innerText = (Math.round((sjtotal + Number.EPSILON) * 100) / 100).toFixed(2);
                calling();
            }
            
        })
    
    // Remove item
    var button = removeCartItemButtons[i];
    const temp = i; 
    button.addEventListener('click', function(event)
    {   

        var buttonClicked = event.target
        buttonClicked.parentElement.parentElement.remove()
        //delete amount from row
        //calsubtotal();
        console.log("remove row: " + temp);
        removeInt(temp);
        calling();
        
    })
}

function calling()
    {
        subtotal_tol = 0;

        subtotal_tol = subtotal_tol + parseFloat(document.getElementById("subtotal_kl").innerHTML) + parseFloat(document.getElementById("subtotal_sj").innerHTML);

        document.getElementById('subtotal_count').innerHTML = (Math.round((subtotal_tol + Number.EPSILON) * 100) / 100).toFixed(2);      
    }  
  