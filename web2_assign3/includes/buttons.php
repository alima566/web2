
<?php
// Print Cart Button - START
$cartId = $_GET['id'];  
$favId = $_GET['id'];
$added = false;
    if (is_array($_SESSION['cart']))
    {
        foreach ($_SESSION['cart'] as $cartItem) //loop through session array var
    	{
    	    if ($id == $cartItem['id']) 
            {
                echo '<a href="cart.php">';  
                echo '<button class="ui compact icon orange button" data-tooltip="View Cart" id="cart">';
                echo '<i class="search icon"></i>';
                echo '</button></a>';
                $added = true;
            }
        }
    }
    
    if (!$added)
    {
        echo '<a href="add-to-cart.php?id[]='. $cartId . '">';  
        echo '<button class="ui compact icon orange button" data-tooltip="Add to Cart">';
        echo '<i class="shop icon"></i>';
        echo '</button></a>';
    }
    
    // Print cart button - END
    // Print fav button - START
    $favAdded = false;
    if (is_array($_SESSION['favPaintings']))
    {
        foreach ($_SESSION['favPaintings'] as $favItem) //loop through session array var
    	{
    	    if ($id == $favItem['id']) 
            {
                echo '<a href="favorites.php">';    
                echo '<button class="ui compact icon button" data-tooltip="View Favorites">';
                echo '<i class="unhide icon"></i>';
                echo '</button></a>';
                $added = true;
            }
        }
    }
    
    if (!$favAdded)
    {
        echo '<a href="add-to-favorites.php?pid='. $favId . '">';    
        echo '<button class="ui compact icon button" data-tooltip="Add to Favorites">';
        echo '<i class="heart icon"></i>';
        echo '</button></a>';
    }
    // Print Fav button - END
?>