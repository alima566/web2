<?php

/*
 * ==============================================================
 * |                                                            |
 * |                         CART PAGE                          |
 * |                                                            |
 * ==============================================================
 */
$totalAddOn = 0;

/**
 * Gets a specific item from the cart
 */ 
function getCartItems ()
{
    $db = connectToDB();
    
    $paintings = new PaintingDB ($db);
    
    $cart = new ShoppingCart();
    
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    
    if (isset($_GET['name']) == "emptyCart")
    {
        emptyCart();
    }
    else if (isset($_GET['remove_item']))
    {
        removeItemFromCart();
    }
    else if (isset($_GET['name']) == "updateCart")
    {
        updateCartItems();
    }
    else if (count($_SESSION['cart']) > 0)
    {
        displayCartTable($paintings);
    }
    else
    {
        printEmptyCartMessage();
    }
    
    $db = null;
}

/**
 * Outputs the table for the cart
 * @param paintings The painting object
 */ 
function displayCartTable ($paintings)
{
    echo '<form method="GET" action="add-to-cart.php">';
    echo '<table class="ui celled padded table">';
    echo '<thead>';
    echo '<tr class="center aligned">';
    echo '<th class="eight wide">Product</th>';
    echo '<th class="one wide">Quantity</th>';
    echo '<th class="one wide">Price</th>';
    echo '<th class="one wide">Add-Ons</th>';
    echo '<th class="one wide">Total</th>';
    echo '</tr></thead>';
    
    foreach ($_SESSION['cart'] as $item => $value)
    {
        $results = $paintings -> findByID($value['id']);
        
        outputCartPaintings ($results, $value['qty'], $value['frame'], $value['glass'], $value['matt']);
    }
     
    echo '</table>';
   
    printButtons(); //prints "Continue Shopping" and "Update Cart" buttons
    echo '</form>';
    echo '<table class="ui collapsing definition padded table" align="right">';
    echo '<tbody>';
    echo '<tr>';
    echo '<td class="right aligned">Subtotal (' . getTotalItems() . printItemOrItems() . ')</td>';
    echo '<td class="right aligned"><strong>$' . number_format(calculateSubtotal($paintings)) . '</strong></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="right aligned">';
    outputShippingOptions($_POST['shipping']); 
    echo '</td>';
    echo '<td class="right aligned"><strong>$' . number_format(calculateShippingCost($paintings)) . '</strong></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="right aligned"><h3 class="ui header">Grand Total</h3></td>';
    echo '<td class="right aligned"><h3 class="ui header">$' . number_format(calculateGrandTotal($paintings)) . '</h3></td>';
    echo '</tr>';
    echo '</tbody>';
    echo '<tfoot class="full-width">';
    echo '<tr>';
    echo '<td colspan="2"><button class="ui fluid green button">';
    echo '<i class="payment icon"></i>Place Order';
    echo '</button></td>';
    echo '</tr>';
    echo '</tfoot>';
    echo '</table>';
}

/**
 * Empty's the entire cart when the user clicks the "Empty Cart" button 
 */
function emptyCart ()
{
    unset($_SESSION['cart']);
        
    header('Location: cart.php');
    
    printEmptyCartMessage();
}
/**
 * Prints a message saying that the cart is empty
 */ 
function printEmptyCartMessage ()
{
    echo '<div class="ui negative message">';
    echo '<div class="header">You have no products in your cart</div>';
    echo '</div>';
}

/**
 * Removes a specfic item from the cart
 */ 
function removeItemFromCart ()
{
    $removeditem = $_GET['remove_item'];
    foreach ($_SESSION['cart'] as $key => $cartItem) 
    {
        if ($cartItem['id'] == $removeditem) 
        {
            unset($_SESSION['cart'][$key]);
        }
    }
    header('Location: cart.php');
}

/**
 * Updates the entire cart
 */ 
function updateCartItems ()
{
    if (isset($_GET['submit'])) 
    {
        echo '<form method="GET" action="add-to-cart.php?id='. $id . '">';
        $id = $_GET['id'];
        
        echo '<input type="hidden" name="id" value="'.  $id . '">';
        echo '<input type="hidden" name="qty" value="'. $_GET['qty'] . '">';
        echo '<input type="hidden" name="frame" value="'. $_GET['frame'] . '">';
        echo '<input type="hidden" name="glass" value="'. $_GET['glass'] . '">';
        echo '<input type="hidden" name="matt" value="'. $_GET['matt'] . '">';
        echo '</form>';
    }
    echo '</form>';
}

/**
 * Outputs a row of paintings for the cart page
 * @param results The SQL result set
 * @param qty The quantity of an item
 * @param frame The frame option
 * @param glass The glass option
 * @param matt The matt option
 */
function outputCartPaintings ($results, $qty, $frame, $glass, $matt)
{
    global $totalAddOn;
    foreach ($results as $row)
    {
        echo '<tr>';
        echo '<td>';
        echo '<div class="ui items">';
        echo '<div class="item">';
        echo '<div class="image">';
        echo '<a href="single-painting.php?id=' . $row['PaintingID'] .'">';
        echo '<img src="images/art/works/square-medium/' . $row['ImageFileName'] . '.jpg" alt="..." title="' . $row['Title']. '"/></a>';
        echo '</div>'; // image
        echo '<div class="content">';
        echo '<a href="single-painting.php?id=' . $row['PaintingID'] . '" class="header">' . $row['Title']. '</a>';
        echo '<a href="cart.php?remove_item='. $row['PaintingID']. '" class="right floated" data-tooltip="Remove Item">';
        echo '<i class="trash outline icon"></i>';
        echo '</a>';
        echo '<div class="description">';
        echo '<p>' . $row['Excerpt'] . '</p>';
        echo '</div><br/>'; // description
        outputFormElements ($row['PaintingID'], $qty, $frame, $glass, $matt);
        echo '</div>'; // content
        echo '</div>'; // item
        echo '</div>';
        echo '</td>';
        echo '<td><div class="ui form">
              <input type="number" name="qty[]" value="' . $qty .'" min="0">
              </div></td>';
        echo '<td class="center aligned">$' . number_format($row['MSRP']) . '</td>';
        echo '<td class="center aligned">$' . number_format($totalAddOn) . '</td>';
        echo '<td class="center aligned">$' . number_format(getBaseCost($qty, $row['MSRP'])) . '</td>';
        echo '</tr>';
    }
}

/**
 * Prints the "Continue Shopping" and "Update Cart" buttons
 */ 
function printButtons ()
{
    echo '<div class="ui compact buttons">';
    echo '<a href="index.php"><button type="button" class="ui fluid blue button">Continue Shopping</button></a>';
    echo '<button class="ui fluid green button"><i class="icon refresh"></i>Update All</button>';
    echo '</div>';
}

/**
 * Gets the base cost by multiplying the quantity and the MSRP and then adding any add-ons
 * @param quantity The quantity of an item
 * @param MSRP The MSRP of an item
 * @return The base cost of an item
 */ 
function getBaseCost ($quantity, $MSRP)
{
    global $totalAddOn;
    return ($quantity * $MSRP) + $totalAddOn;
}

/**
 * Calculates the subtotal for the entire cart
 * @param paintings The painting object
 * @return The subtotal of the entire cart
 */ 
function calculateSubtotal ($paintings)
{
    $subtotal = 0;
    
    foreach ($_SESSION['cart'] as $key => $value)
    {
        $sql = $paintings -> getCost($value['id']);
        $results = $paintings -> getAll($sql);
        
        foreach ($results as $row)
        {
            $subtotal = getBaseCost($value['qty'], $row['MSRP']) + $subtotal;
        }
    }
    return $subtotal;
}

/**
 * Gets the matt cost for an item
 * @param mattName The matt name
 * @param paintingID The painting ID for a specific item
 * @return The total matt cost for an item
 */ 
function getMattCost ($mattName, $paintingID)
{
    $mattCost = 10;
    foreach ($_SESSION['cart'] as $key => $value)
    {
        if ($value['id'] == $paintingID)
        {
            $mattCost = ($mattName == "[None]") ? 0 : $value['qty'] * $mattCost;
            break;
        }
    }
    return $mattCost;
}

/**
 * Gets the frame cost for an item
 * @param frameName The frame name
 * @param paintingID The painting ID for a specfic item
 * @param frames The frame object
 * @return frameCost The total frame cost for an item
 */ 
function getFrameCost ($frameName, $paintingID, $frames)
{
    $frameCost = 0;
    $results = $frames -> findByName($frameName);
    
    foreach ($results as $row)
    {
        $frameCost = $row['Price'];
    }
    
    foreach ($_SESSION['cart'] as $key => $value)
    {
        if ($value['id'] == $paintingID)
        {
            $frameCost = ($frameName == '[None]') ? 0 : $value['qty'] * $frameCost;
            break;
        }
    }
    return $frameCost;
}

/**
 * Gets the glass cost for an item
 * @param glassName The glass name
 * @param paintingID The painting ID for a specific item
 * @param glass The glass objecy
 * @param glassCost The total glass cost for an item
 */ 
function getGlassCost ($glassName, $paintingID, $glass)
{
    $glassCost = 0;
    $results = $glass -> findByName($glassName);
    foreach ($results as $row)
    {
        $glassCost = $row['Price'];
    }
    
    foreach ($_SESSION['cart'] as $key => $value)
    {
        if ($value['id'] == $paintingID)
        {
            $glassCost = ($glassName == '[None]') ? 0 : $value['qty'] * $glassCost;
            break;
        }
    }
    return $glassCost;
}

/**
 * Calculates the shipping cost for the entire order
 * @param paintings The painting object
 * @return The shipping cost for the entire order
 */ 
function calculateShippingCost ($paintings)
{
    $shippingCost = 0;
    if (isset($_POST['shipping']) && $_POST['shipping'] == 'standard')
    {
        if (calculateSubtotal($paintings) < 1500)
        {
            $shippingCost = 25 * getTotalItems();
        }
    }
    if (isset($_POST['shipping']) && $_POST['shipping'] == 'express')
    {
        if (calculateSubtotal($paintings) < 2500)
        {
            $shippingCost = 50 * getTotalItems();
        }
    }
    return $shippingCost;
}

/**
 * This function uses the query string $_GET["shipping"] passed to it to determine if the shipping type selected was standard or express
 * Based of the query string it will display the shipping options (radio buttons)
 * @param $post $_POST["shipping"] to determine shipping options
 */
function outputShippingOptions ($post)
{
    echo '<form method="POST" action="cart.php">';
        echo '<div class="left aligned">';
            if ($post =='express')
            {
                 echo '<input type="radio" name="shipping" value="standard"> Standard Shipping <br>';
                 echo '<input type="radio" name="shipping" value="express" checked="checked"> Express Shipping <br>';
            }
            else
            {
                echo '<input type="radio" name="shipping" value="standard" checked="checked"> Standard Shipping <br>';
                echo '<input type="radio" name="shipping" value="express"> Express Shipping<br>';
            }
        echo '</div><br>';
        echo '<button class="circular mini ui icon button"><i class="shipping icon"></i> Calculate Shipping</button>';
    echo '</form>';
}

/**
 * Calculates all the add-on costs for an item (frames + glass + matt)
 * @param framesCost The total cost of the frames
 * @param glassCost The total cost of the glass
 * @param mattCost The total cost of the matts
 * @return The total of all the frames, glass and matt cost added together
 */ 
function calculateAddOnCost ($framesCost, $glassCost, $mattCost)
{
    global $totalAddOn; 
    return $totalAddOn = $framesCost + $glassCost + $mattCost;
}

/**
 * Calculates the grand total by adding up the subtotal and the shipping cost
 * @return The grand total of the entire cart
 */ 
function calculateGrandTotal ($paintings)
{
    return calculateSubtotal($paintings) + calculateShippingCost($paintings);
}

/**
 * Gets the total items in the shopping cart
 * @return The number of total items in the cart
 */
function getTotalItems ()
{
    $totalItems = 0;
    foreach ($_SESSION['cart'] as $key => $value)
    {
        $totalItems = $value['qty'] + $totalItems;
    }
    return $totalItems;
}

/**
 * Depending on the number of items in the cart, it will either print "item" or "items"
 * @return "Item" if the total is less than or equal to 1; "Items" otherwise
 */ 
function printItemOrItems ()
{
    return (getTotalItems() <= 1) ? ' item' : ' items';
}

/**
 * This function outputs form elements (e.g Frame, Glass, and Matt option list) corresponding to a unique painting
 * @param id Painting ID to determine the unique painting
 * @param qty The quantity of a specific item
 * @param frameID Frame ID to populate frame list
 * @param glassID Glass ID to populate glass list
 * @param mattID Matt IDto populate att list
*/
function outputFormElements ($id, $qty, $frameID, $glassID, $mattID)
{
    $db = connectToDB();
    
    $frames = new FrameDB ($db);
    $glass = new GlassDB ($db);
    $matt = new MattDB ($db);
    
    $framesCost = getFrameCost($frameID, $id, $frames);
    $glassCost = getGlassCost($glassID, $id, $glass);
    $mattCost = getMattCost($mattID, $id);
    
    calculateAddOnCost($framesCost,$glassCost, $mattCost);

    echo '<div class="ui form">';
    echo '<div class="three fields">';

    echo '<div class="four wide field">
          <label>Frame ($' . number_format($framesCost, 2) . ')</label>
          <select id="frame" name="frame[]" class="ui search dropdown">';
    echo '<option selected="selected">'. $frameID .'</option>';
          retrieveFrameOptions () ;
    echo '</select>
          </div>'; // four wide field
          
    echo '<div class="four wide field">
          <label>Glass ($' . number_format($glassCost, 2) . ')</label>
          <select id="glass" name="glass[]" class="ui search dropdown">';
    echo '<option selected="selected">'. $glassID .'</option>';
          retrieveGlassOptions ();
    echo '</select>
          </div>'; // four wide field
          
    echo '<div class="four wide field">
          <label>Matt ($' . number_format($mattCost, 2) . ')</label>
          <select id="matt"  name="matt[]" class="ui search dropdown">';
    echo '<option selected="selected">'. $mattID .'</option>';
          retrieveMattOptions() ;
    echo '</select>';
    
    echo '</div>'; // four wide field
    echo '<input type="hidden" name="id[]" value="'.  $id . '">';
    echo '</div>'; // three fields
    echo '</div>'; // ui form
}

?>