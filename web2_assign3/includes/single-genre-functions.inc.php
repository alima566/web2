<?php

/*
 * ==============================================================
 * |                                                            |
 * |                     SINGLE-GENRE PAGE                      |
 * |                                                            |
 * ==============================================================
 */
 
/**
 * Gets the genre information for a specfic genre
 */ 
function getGenreInformation ()
{
    $db = connectToDB();
    
    $genres = new GenreDB ($db);
    
    $results = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $genres -> findByID($_GET['id']) : $genres -> findByID(33);
    
    outputGenreInformation($results);
    
    echo '<section class="ui container">';
    echo '<h3 class="ui dividing header">Paintings</h3>';
    
    outputGenrePaintings($genres);
    
    echo '</section>';
    
    $db = null;
}

/**
 * Outputs the genre information for a specific genre
 * @param results The result set
 */ 
function outputGenreInformation ($results)
{
    echo '<div class="ui message">';
    echo '<div class="ui container">';
    echo '<div class="ui items">';
    foreach ($results as $row)
    {
        echo '<div class="item">';
        echo '<div class="image">';
        echo '<img src="images/art/genres/square-medium/' . $row['GenreID'] . '.jpg" alt="..." />';
        echo '</div>'; // image
        echo '<div class="content">';
        echo '<h1 class="ui header">' . $row['GenreName'] . '</h1>';
        echo '<div class="description">';
        echo '<p>' . $row['Description'] . '</p>';
        echo '</div>'; // description
        echo '</div>'; // content
        echo '</div>'; // item
    }
    echo '</div>'; // ui items
    echo '</div>'; // ui container
    echo '</div>'; // ui message
}

/**
 * Outputs all the paintings related to the specfic genre
 */ 
function outputGenrePaintings ($genres)
{
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $genres -> findByPainting($_GET['id']) : $genres -> findByPainting(33);
    
    $results = $genres -> getAll($sql);
    
    outputPaintingsPanel($results);
}

?>