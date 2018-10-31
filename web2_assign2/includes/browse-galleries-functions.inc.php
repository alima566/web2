<?php

/*
 * ==============================================================
 * |                                                            |
 * |                   BROWSE-GALLERIES PAGE                    |
 * |                                                            |
 * ==============================================================
 */

/**
 * Outputs all the galleries, sorted by gallery name
 */
function outputGalleries ()
{
    $db = connectToDB();
    
    $galleries = new GalleryDB ($db);
    
    $results = $galleries -> getAll(null);
    
    foreach ($results as $row)
    {
        echo '<div class="ui fluid card">';
        echo '<div class="content">';
        echo '<h4 class="ui header">';
        echo '<a class="header" href="single-gallery.php?id=' . $row['GalleryID'] . '">' . $row['GalleryName'] . '</a>';
        echo '</h4>';
        echo '</div>'; // content
        echo '<div class="extra content">';
        echo '<div class="ui list">';
        echo '<div class="item">';
        echo '<i class="marker icon"></i>';
        echo '<div class="content">'. $row['GalleryCity'] . ', ' . $row['GalleryCountry'] . '</div>';
        echo '</div>'; // item
        echo '</div>'; // ui list
        echo '</div>'; // extra content
        echo '</div>'; // ui fluid card
    }
    
    $db = null;
}

?>