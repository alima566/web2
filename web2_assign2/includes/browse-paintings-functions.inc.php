<?php

/*
 * ==============================================================
 * |                                                            |
 * |                    BROWSE-PAINTINGS PAGE                   |
 * |                                                            |
 * ==============================================================
 */
 
/**
 * Outputs the Top 20 Paintings sorted by year
 * @param results The result set
 */ 
function outputPaintings ($results)
{
    foreach ($results as $row)
    {
        echo '<div class="item">';
        echo '<a href="single-painting.php?id=' . $row['PaintingID'] . '" class="image">';
        echo '<img src="images/art/works/square-medium/' . $row['ImageFileName'] . '.jpg" alt="..." title="' . $row['Title']. '"/></a>';
        echo '<div class="content">';
        echo '<a href="single-painting.php?id=' . $row['PaintingID'] . '" class="header">' . $row['Title']. '</a>';
        echo '<div class="meta">';
        echo '<span>' . $row['FirstName'] . ' ' . $row['LastName'] . '</span>';
        echo '</div>'; // meta
        echo '<div class="description">';
        echo '<p>' . $row['Excerpt'] . '</p>';
        echo '<p>$' . number_format($row['MSRP']) . '</p>';
        
        printCartButton($row['PaintingID']);
        printFavButton($row['PaintingID']);
        
        echo '</div>'; // description
        echo '</div>'; // content
        echo '</div>'; // item
            
        echo '<div class="ui divider"></div>';
    }
}

/**
 * Prints the cart button. If the painting isn't in the cart, it will display "Add to Cart".
 * If the painting is already in the cart, it will display "View Cart"
 * @param id The painting ID
 */ 
function printCartButton ($id)
{
    $added = false;
    if (is_array($_SESSION['cart']))
    {
        foreach ($_SESSION['cart'] as $cartItem) //loop through session array var
    	{
    	    if ($id == $cartItem['id']) 
            {
                echo '<a href="cart.php">';  
                echo '<button class="ui compact icon orange button" data-tooltip="View Cart">';
                echo '<i class="search icon"></i>';
                echo '</button></a>';
                $added = true;
            }
        }
    }
    
    if (!$added)
    {
        echo '<a href="add-to-cart.php?id[]='. $id . '">';  
        echo '<button class="ui compact icon orange button" data-tooltip="Add to Cart">';
        echo '<i class="shop icon"></i>';
        echo '</button></a>';
    }
}

/**
 * Prints the favorite button. If the painting isn't already in the favorites list, it will display "Add to Favorites".
 * If the painting is already in the favorites list, it will display "View Favorites"
 */ 
function printFavButton ($id)
{
    $added = false;
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
    
    if (!$added)
    {
        echo '<a href="add-to-favorites.php?pid='. $id . '">';    
        echo '<button class="ui compact icon button" data-tooltip="Add to Favorites">';
        echo '<i class="heart icon"></i>';
        echo '</button></a>';
    }
}

/**
 * If the user has searched for a painting using the filters on the left, it will determine which filter was selected
 * And outputs the relevent paintings for that selected filter
 * @param painting The painting object
 */ 
function getFilteredSearchResults ($painting)
{
    if (isset($_GET['artist']) && !empty($_GET['artist']))
    {
        $sql = $painting -> findByArtist($_GET['artist']);
    }
    else if (isset($_GET['museum']) && !empty($_GET['museum']))
    {
        $sql = $painting -> findByGallery($_GET['museum']);
    }
    else if (isset($_GET['shape']) && !empty($_GET['shape']))
    {
        $sql = $painting -> findByShape($_GET['shape']);
    }
    
    $results = $painting -> getAll($sql);
    outputPaintings($results);
}

/**
 * Outputs the artist dropdown list
 */ 
function artistDropdownList ()
{
    $db = connectToDB();
    
    $artists = new ArtistDB ($db);
    
    $results = $artists -> getAll(null);
    foreach ($results as $row)
    {
        $artistName = $row['FirstName'] . ' ' . $row['LastName'];
        outputFilterDropdownLists($row['ArtistID'], $artistName);
    }
    
    $db = null;
}

/**
 * Outputs the museum dropdown list
 */
function museumDropdownList ()
{
    $db = connectToDB();
      
    $galleries = new GalleryDB ($db);
    
    $results = $galleries -> getAll(null);
    
    foreach ($results as $row)
    {
        outputFilterDropdownLists($row['GalleryID'], $row['GalleryName']);
    }
    
    $db = null;
}

/**
 * Outputs the shape dropdown list
 */
function shapeDropdownList ()
{
    $db = connectToDB();
    
    $shapes = new ShapeDB ($db);
    
    $results = $shapes -> getAll(null);
    
    foreach ($results as $row)
    {
        outputFilterDropdownLists($row['ShapeID'], $row['ShapeName']);
    }
    
    $db = null;
}

/**
 * Outputs the options for the dropdown lists
 * @param id The ID number for the artist, museum or shape
 * @param name The name of the artist, museum or shape
 */ 
function outputFilterDropdownLists ($id, $name)
{
    echo '<option class="item" value="' . $id . '">' . $name . '</option>';
}

?>