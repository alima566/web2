<?php

class ShoppingCart
{
	// Array stores the list of items in the cart:
	public $cart = array();
	
	// For tracking iterations:
	public $position = 0;

	// For storing the IDs, as a convenience:
	public $ids = array ();

    // Constructor just sets the object up for usage:
   // constructor accepts the session variable to create cart object
	public function __construct()
	{
		if(!isset($_SESSION['cart']))
		{
			$_SESSION['cart'] = array();
		}
	}

	// Returns a Boolean indicating if the cart is empty:
	public function isEmpty () 
	{
		return (empty($this -> cart));
	}

	// Adds a new item to the cart:
	public function addItem ($item) 
	{
		// Need the item id:
		$id = $item['id'];
		$found = false;
	
		// Add or update:
		foreach ($_SESSION["cart"] as $cart_itm) //loop through session array var
		{                        
		    if($item['id'] === $cart_itm['id']) 
		    {
		        $found = true;
		        break;
		    }
		}
		if ($found === true)
		{
			$this->updateItem ($item);
		} 
		else 
		{
			array_push($_SESSION['cart'], $item);
			$found = false;

		}
	}
		
	public function updateItem ($item) // Updates an item already in the cart:
	{
		foreach($_SESSION['cart'] as $key => $value)
		{
			if($value['id'] == $item['id'])
			{
				$_SESSION['cart'][$key]['qty'] = $item['qty'];
				$_SESSION['cart'][$key]['frame'] = $item['frame'];
				$_SESSION['cart'][$key]['glass'] = $item['glass'];
				$_SESSION['cart'][$key]['matt'] = $item['matt'];
			}
		}
	}

	// Removes an item from the cart:
	public function deleteItem () 
	{
	    $removeditem = $_GET['remove_item'];
	    foreach ($_SESSION['cart'] as $key => $cartItem) 
	    {
	        if ($cartItem["id"] == $removeditem) 
	        {
	            unset($_SESSION['cart'][$key]);
	        }
	    }
	    header('Location: cart.php');
		
	}
	
}