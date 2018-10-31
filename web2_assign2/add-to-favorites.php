<?php 
session_start();

/*****
	Used an approach best suitable to seperate "Favourite Paintings" vs. "Favourite Artists" sessions,
	Allowing to better distinguish and present data to the user.This approach will allow to print two 
	seperate lists, one for paintings and the other for artists.
*****/

/**
 * Checks the query string to determine if a painting or artist is being added.
 */
$pid = isset($_GET['pid']) && !empty(intval($_GET['pid'])) ? intval($_GET['pid']) : null;
$aid = isset($_GET['aid']) && !empty(intval($_GET['aid'])) ? intval($_GET['aid']) : null;

if (!isset($_SESSION['favPaintings']))
{
    $_SESSION['favPaintings'] = array();
}
if (!isset($_SESSION['favArtists']))
{
	$_SESSION['favArtists'] = array();
}

if (exists($pid, $_SESSION['favPaintings'])) //Check to see if this item already exists
{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
} 
else if (exists($aid, $_SESSION['favArtists']))
{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
	$sessionID = (is_null($pid)) ? $aid : $pid;
	$sessionType = (is_null($pid)) ? 'favArtists' : 'favPaintings';
	
    array_push($_SESSION[$sessionType], array("id" => $sessionID));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

/**
 * Checks to see if an item already exists in the favorites list
 * @param id The painting/artist ID
 * @param session The session type
 * @return Returns true if item already exists; false otherwise
 */
function exists ($id, $session)
{
	foreach ($session as $fav_itm) //loop through session array var
	{                        
	    if ($id === $fav_itm['id']) 
	    {
	       return true;
	    }
	}
	return false;
}

?>