<?php 

require_once('config.php');

spl_autoload_register (function ($class) //Auto loads all the class files
{
    $file = 'Class Files/' . $class . '.class.php';
    if (file_exists($file))
    {
        include $file;
    }
});

session_start(); //Starting session

$cart = new ShoppingCart();

/**
 * As soon as the data is forwarded to this page (add-to-cart.php), the following foreach loop will extract the 
 * query string data and use it to call "addItem($id, $qty, $frame, $glass, $matt)" in the "ShoppingCart" class
 */
    foreach ($_GET['id'] as $key => $value)
    {
        $id = isset($_GET['id']) && !empty(intval($_GET['id'][$key])) ? intval($_GET['id'][$key]) : 420;
        $qty = isset($_GET['qty']) && !empty(intval($_GET['qty'][$key])) ? intval($_GET['qty'][$key]) : 1;
        $frame = isset($_GET['frame']) ? $_GET['frame'][$key] : "[None]";
        $glass = isset($_GET['glass']) ? $_GET['glass'][$key] : "[None]";
        $matt = isset($_GET['matt']) ? $_GET['matt'][$key] : "[None]";
        
        $cart -> addItem(array("id" => $id, "qty" => $qty, "frame" => $frame, "glass" => $glass, "matt" => $matt));
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']); // reforwards back to the referring(invoking) page
?>