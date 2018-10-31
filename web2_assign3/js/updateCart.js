$(function()
{
    $("select").on('change', function ()
    {
           this.form.submit();
    });         
    $("input").change(function ()
    {
           this.form.submit();
    }); 
});  
    //  calculateSubtotal(url);
    //  updatePrice();
    //calculateSubtotal();

// function updatePrice()
// {
//     $('input[id=qty]').change( function() 
//     {
//         var number = $(this).closest('tr').find('#price').text();
//         var price = Number(number.replace(/[^0-9\.]+/g,""));
//         console.log(number);
//         var total = (price * this.value);
//         console.log(total)
//          $(this).closest('tr').find('#total').html('$'+ addCommas(total));
//     });
   
// }

/**
 * Calculates the shipping cost for the entire order
 * @param paintings The painting object
 * @return The shipping cost for the entire order
 */ 
// function calculateShippingCost (url)
// {
//     var shippingCost = 0;
//     //$.post('cart.php?shipping='+  $('.prompt').val(),
//     if (isset($_POST['shipping']) && $_POST['shipping'] == 'standard')
//     {
//         if (calculateSubtotal(url) < 1500)
//         {
//             shippingCost = 25 * getTotalItems(url);
//         }
//     }
//     if (isset($_POST['shipping']) && $_POST['shipping'] == 'express')
//     {
//         if (calculateSubtotal(url) < 2500)
//         {
//             shippingCost = 50 * getTotalItems(url);
//         }
//     }
//     return shippingCost;
// }

/**
 * Gets the total items in the shopping cart
 * @return The number of total items in the cart
 */
// function getTotalItems (url)
// {
//     var totalItems = 0;

//     $.get(url)
//     .done(function (data)
//     {
//         $.each(data, function (index, value)
//         {
//             totalItems += $('#qty').val();
//         })
//     })
//     return totalItems;
// }

// function printItemOrItems (url)
// {
//     return (getTotalItems(url) <= 1) ? ' item' : ' items';
// }

// /**
//  * Calculates the subtotal for the entire cart
//  * @return The subtotal of the entire cart
//  */ 
// function calculateSubtotal (url)
// {
//     var subtotal = 0;

//     $.get(url)
//     .done(function (data)
//     {
//         $.each(data, function (index, value)
//         {
//             subtotal += getBaseCost($('#qty').val(), value.MSRP);
//         })
//     })
//     return subtotal;
// }

// function getBaseCost (quantity, MSRP)
// {
//     //global $totalAddOn;
//     return (quantity * MSRP) + totalAddOn;
// }

// function addCommas(nStr)
// {
// 	nStr += '';
// 	x = nStr.split('.');
// 	x1 = x[0];
// 	x2 = x.length > 1 ? '.' + x[1] : '';
// 	var rgx = /(\d+)(\d{3})/;
// 	while (rgx.test(x1)) {
// 		x1 = x1.replace(rgx, '$1' + ',' + '$2');
// 	}
// 	return x1 + x2;
// }