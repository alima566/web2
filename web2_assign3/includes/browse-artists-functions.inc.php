<?php

/*
 * ==============================================================
 * |                                                            |
 * |                     BROWSE-ARTISTS PAGE                    |
 * |                                                            |
 * ==============================================================
 */
 
/**
 * Outputs all the artists sorted by last name
 */
function outputArtists ()
{
    $db = connectToDB();
    
    $artists = new ArtistDB ($db);
    $results = $artists -> getAll(null);
    
    foreach ($results as $row)
    {
        echo '<div class="ui fluid card">';
        echo '<a class="image" href="single-artist.php?id=' . $row['ArtistID'] . '" class="ui medium image">';
        echo '<img src="images/art/artists/square-medium/' . $row['ArtistID'] . '.jpg" alt="..." title="' . $row['FirstName'] . ' ' . $row['LastName'] . '"/></a>';
        echo '<div class="content">';
        echo '<h4 class="ui header">';
        echo '<a class="header" href="single-artist.php?id=' . $row['ArtistID'] . '">' . $row['FirstName'] . ' ' . $row['LastName'] . '</a>';
        echo '</h4>';
        echo '</div>'; // content
        echo '</div>'; // ui card
    }
    
    $db = null;
}

?>