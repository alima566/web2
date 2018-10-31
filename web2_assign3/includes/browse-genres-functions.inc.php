<?php

/*
 * ==============================================================
 * |                                                            |
 * |                    BROWSE-GENRES PAGE                      |
 * |                                                            |
 * ==============================================================
 */
 
/**
 * Outputs all the genres, sorted by Era ID, for the browse genres page
 */ 
function outputAllGenres ()
{
    $db = connectToDB();
    
    $genres = new GenreDB ($db);
    
    $results = $genres -> getAll(null);
    
    foreach ($results as $row)
    {
        echo '<div class="ui fluid card">';
        echo '<a class="image" href="single-genre.php?id=' . $row['GenreID'] . '" class="ui medium image">';
        echo '<img src="images/art/genres/square-medium/' . $row['GenreID'] . '.jpg" alt="..." title="' . $row['GenreName'] . '"/></a>';
        echo '<div class="content">';
        echo '<h4 class="ui header">';
        echo '<a class="header" href="single-genre.php?id=' . $row['GenreID'] . '">' . $row['GenreName'] . '</a>';
        echo '</h4>';
        echo '</div>'; // content
        echo '</div>'; // ui card
    }
    
    $db = null;
}

?>