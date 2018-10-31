<?php

/*
 * ==============================================================
 * |                                                            |
 * |                       FAVORITES PAGE                       |
 * |                                                            |
 * ==============================================================
 */
 
/**
 * Gets all the favorite items that the user has added to their favorites list
 */
function getFavItems ()
{
    $db = connectToDB();;
    
    $paintings = new PaintingDB ($db);
    $artists = new ArtistDB($db);
    
    $action = isset($_GET['action']) ? $_GET['action'] : "";
        
    if (isset($_GET['name']))
    {
        clearFavorites ();
    }
    else if (isset($_GET['remove_item']))
    {
        removeFavItem('favPaintings');
        removeFavItem('favArtists');
    }
    
    if (count($_SESSION['favPaintings']) > 0)
    {
        echo '<div class="ui attached message">';
        echo '<div class="header">Favorite Paintings</div>';
        echo '</div>'; // ui message
        echo '<div class="ui attached items fluid segment">';
        displayFavs('favPaintings', $paintings);
        echo '</div><br>';
    }
    
    if (count($_SESSION['favArtists']) > 0)
    {
        echo '<div class="ui attached message">';
        echo '<div class="header">Favorite Artists</div>';
        echo '</div>'; // ui message
        echo '<div class="ui attached items fluid segment">';
        displayFavs('favArtists', $artists);
        echo '</div>';
    }
    
    if (count($_SESSION['favArtists']) == 0 && count($_SESSION['favPaintings']) == 0)
    {
        printNoFavsMessage();
    }
    
    $db = null;
}

/**
 * Displays all the favorites that the user has added
 * @param sessionType The sesstion type (either 'favPaintings' or 'favArtists')
 * @param object The object that we are trying to retrieve (either ArtistDB or PaintingDB)
 */
function displayFavs ($sessionType, $object)
{
    foreach ($_SESSION[$sessionType] as $item => $value)
    {
        $results = $object -> findByID($value['id']);
        if ($sessionType === 'favPaintings')
        {
            outputFavPaintings ($results);
        }
        else
        {
            outputFavArtists ($results);
        }
    }
}

/**
 * Removes a specific item from the favorite lists
 * @param sessionType The session type (either 'favPaintings' or 'favArtists')
 */ 
function removeFavItem ($sessionType)
{
    $removeditem = $_GET['remove_item'];
    foreach ($_SESSION[$sessionType] as $key => $cartItem) 
    {
        if ($cartItem["id"] == $removeditem) 
        {
            unset($_SESSION[$sessionType][$key]);
        }
    }
    header('Location: favorites.php');
}

/**
 * Empties the favorites list
 */ 
function clearFavorites ()
{
    unset($_SESSION['favPaintings']);
    unset($_SESSION['favArtists']);
    header('Location: favorites.php');
    
    printNoFavsMessage();
}

/**
 * Prints out a message saying that there are no favorites
 */ 
function printNoFavsMessage ()
{
    echo '<div class="ui negative message">';
    echo '<div class="header">You have no favorites</div>';
    echo '</div>';
}

/**
 * Outputs all the paintings that are in the favorites
 * @param results The results set
 */ 
function outputFavPaintings ($results)
{
    foreach ($results as $row)
    {
        echo '<div class="item">';
        echo '<div class="ui tiny image">';
        echo '<img src="images/art/works/square-small/' . $row['ImageFileName'] . '.jpg" alt="..." title="' . $row['Title']. '"/>';
        echo '</div>'; //image
        echo '<div class="middle aligned content">';
        echo '<a href="single-painting.php?id=' . $row['PaintingID'] . '">' . $row['Title']. '</a>';
        echo '<a href="favorites.php?remove_item='. $row['PaintingID']. '" class="right floated" data-tooltip="Remove Painting">';
        echo '<i class="trash outline icon"></i>';
        echo '</a>';
        echo '</div>'; // content
        echo '</div>'; // item
    }
}

/**
 * Outputs all the artists that are in the favorites
 * @param results The results set
 */ 
function outputFavArtists ($results)
{
    foreach ($results as $row)
    {
        echo '<div class="item">';
        echo '<div class="ui tiny image">';
        echo '<img src="images/art/artists/square-thumb/' . $row['ArtistID'] . '.jpg" alt="..." title="' . $row['FirstName'] . ' ' .$row['LastName'] . '" />';
        echo '</div>'; // image
        echo '<div class="middle aligned content">';
        echo '<a href="single-artist.php?id=' . $row['ArtistID'] . '">' . $row['FirstName'] . ' ' . $row['LastName'] . '</a>';
        echo '<a href="favorites.php?remove_item='. $row['ArtistID']. '" class="right floated" data-tooltip="Remove Artist">';
        echo '<i class="trash outline icon"></i>';
        echo '</a>';
        echo '</div>'; // content
        echo '</div>'; // item
    }
}

?>