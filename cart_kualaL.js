var kltotal = 0;
        
//count input + unitprice
// testing set a id for each item count class name
var count_input = document.getElementsByClassName('sub_kl')
    console.log(count_input)

var removeCartItemButtons = document.getElementsByClassName('removeItem_kl')
    console.log(removeCartItemButtons)

// auto subtotal
calsubtotal(); 
  
// function to count subtotal
function calsubtotal()
{
kltotal = 0;
var count_input2 = document.getElementsByClassName('count-input-kl')
for (let index = 0; index < count_input2.length; index++) {
   
    kltotal = kltotal + Number(document.getElementById('subkl['+index+']').value);
}

document.getElementById('subtotal_kl').innerHTML = (Math.round((kltotal + Number.EPSILON) * 100) / 100).toFixed(2);
}

// Use array to find the row index
const arr = new Array();
function useArray()
{
kltotal = 0;

var count_input2 = document.getElementsByClassName('count-input-kl');
for (let index = 0; index < count_input2.length; index++) {
    
    arr[index] = index;
};

console.log('arr length: ' + arr.length);
for (let index = 0; index < arr.length; index++) {
    kltotal = kltotal + Number(document.getElementById('subkl['+arr[index]+']').value);
}
document.getElementById('subtotal_kl').innerHTML = (Math.round((kltotal + Number.EPSILON) * 100) / 100).toFixed(2);
}

// function remove item
function removeint(x)
{
kltotal =0;
for( var i = 0; i < arr.length; i++)
{ 
    
    if ( arr[i] == x) 
    { 
    
        arr.splice(i, 1); 
    }
    
}

console.log("after remove arr length: " + arr.length);
for (let index = 0; index < arr.length; index++) {
    kltotal = kltotal + Number(document.getElementById('subkl['+arr[index]+']').value);
}
document.getElementById('subtotal_kl').innerHTML = (Math.round((kltotal + Number.EPSILON) * 100) / 100).toFixed(2);
//useArray();
} 
//  for loop increment and decrement
useArray();
for (var i = 0; i < count_input.length; i++) 
{
     
    console.log('loop: ' + i);

    //item counting
    var additembtn_kl = document.getElementById('addkl['+i+']');
    var countitembtn_kl = document.getElementById('numkl['+i+']');
    var minusitembtn_kl = document.getElementById('minkl['+i+']');
    
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

    let n = 1;
    let uniprice_kl = unitpricef_kl;
    let toprice_kl = uniprice_kl;


        // Increment count
        additembtnt_kl.addEventListener("click", ()=>{
            var subtotal = 0;
            n++;
            countitembtnt_kl.innerHTML = n.toString();

            kltotal = kltotal - toprice_kl;

            //display price each item
            toprice_kl = n * unitpricef_kl;
            //subtotal = subtotal + toprice;
            totalpricef_kl.value = (Math.round((toprice_kl + Number.EPSILON) * 100) / 100).toFixed(2);
            textpricef_kl.innerHTML = (Math.round((toprice_kl + Number.EPSILON) * 100) / 100).toFixed(2);

            //cal final sub total
            kltotal = kltotal + toprice_kl;

            
            document.getElementById('subtotal_kl').innerHTML = (Math.round((kltotal + Number.EPSILON) * 100) / 100).toFixed(2);
            calling();
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
                //subtotal = subtotal - toprice;
                totalpricef_kl.value = (Math.round((toprice_kl + Number.EPSILON) * 100) / 100).toFixed(2);
                textpricef_kl.innerHTML = (Math.round((toprice_kl + Number.EPSILON) * 100) / 100).toFixed(2);


                //cal final sub total
                kltotal = kltotal + toprice_kl;

                
                document.getElementById('subtotal_kl').innerText = (Math.round((kltotal + Number.EPSILON) * 100) / 100).toFixed(2);
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
        console.log("remove row: " + temp);
        removeint(temp);
        calling();
    }) 
}

function calling()
    {
        subtotal_tol = 0;

        subtotal_tol = subtotal_tol + parseFloat(document.getElementById("subtotal_kl").innerHTML) + parseFloat(document.getElementById("subtotal_sj").innerHTML);

        document.getElementById('subtotal_count').innerHTML = (Math.round((subtotal_tol + Number.EPSILON) * 100) / 100).toFixed(2);      
    }  
 