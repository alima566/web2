<?php
require_once('config.php'); //Loads the config.php file which includes the DBHOST, DBUSER and DBPASS values

spl_autoload_register (function ($class) //Auto loads all the class files
{
    $file = 'Class Files/' . $class . '.class.php';
    if (file_exists($file))
    {
        include $file;
    }
});

session_start();

/*
 * ==============================================================
 * |                       FUNCTIONS USED                       |
 * |                      ON MULTIPLE PAGES                     |
 * |                                                            |
 * ==============================================================
 */
 
/**
 * Creates a connection to the database
 */ 
function connectToDB ()
{
    $connect = array(DBHOST, DBUSER, DBPASS);
    return DBHelper::createConnection($connect);
} 

/**
 * Outputs all the paintings for a specfic genre, artist, and gallery
 * @param results The result set
 */ 
function outputPaintingsPanel ($results)
{
    echo '<div class="ui small images">';
    foreach ($results as $row)
    {
        echo '<a href="single-painting.php?id=' . $row['PaintingID'] . '">';
        echo '<img src="images/art/works/square-medium/' . $row['ImageFileName'] . '.jpg" title="'. $row['Title'] .'" alt="..." id="hover"/></a>';
    }
    echo '</div>';
}

/**
 * Displays the frame options for a single painting
 */ 
function retrieveFrameOptions ()
{   
    $db = connectToDB();
    $frames = new FrameDB ($db);
    
    $results = $frames -> getAll(null);
    
    foreach ($results as $row)
    {
        outputDropdownLists($row['FrameID'], $row['Title']);
    }
    
    $db = null;
}

/**
 * Displays the glass options for a single painting
 */
function retrieveGlassOptions ()
{
    $db = connectToDB();
    $glass = new GlassDB ($db);
    
    $results = $glass -> getAll(null);
    
    foreach ($results as $row)
    {
        outputDropdownLists($row['GlassID'], $row['Title']);
    }
    
    $db = null;
}

/**
 * Displays the matt options for a single painting
 */
function retrieveMattOptions ()
{
    $db = connectToDB();
    $matt = new MattDB ($db);
    
    $results = $matt -> getAll(null);
    
    foreach ($results as $row)
    {
        outputDropdownLists($row['MattID'], $row['Title']);
    }
    
    $db = null;
}

/**
 * Outputs the favorites button for a single painting or a single artist
 * @param identifier The identifier that identifies which favorites list to add to (either favorite paintings or favorite artists)
 * @param session The session to add to (either 'favPaintings' or 'favArtists')
 */
function favButton ($identifier, $session)
{
    $added = false;
    if (is_array($_SESSION[$session]))
    {
        foreach ($_SESSION[$session] as $fav_itm) //loop through session array var
    	{
    	    if($_GET['id'] == $fav_itm['id']) 
            {
                echo '<button class="ui right floated labeled icon disabled button">
                      <i class="user icon"></i>
                        Added to Favorites
                      </button>';
                $added = true;
            }
        }
    }
    if (!$added)
    {
        echo '<a href="add-to-favorites.php?' . $identifier . '='. $_GET['id'] . '">
              <button type="button" class="ui right floated labeled icon button">
                <i class="heart icon"></i>
                 Add to Favorites
              </button> 
              </a>';
    }
}

/**
 * Outputs the options for the dropdown lists
 * @param id The ID of the frame, glass or matt
 * @param name The name of the frame, glass or matt
 */ 
function outputDropdownLists ($id, $name)
{
    echo '<option class="item" value="' . $name . '">' . $name . '</option>';
}

?>