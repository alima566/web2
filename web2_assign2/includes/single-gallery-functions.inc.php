<?php

/*
 * ==============================================================
 * |                                                            |
 * |                    SINGLE-GALLERY PAGE                     |
 * |                                                            |
 * ==============================================================
 */

/**
 * Gets information about a single gallery
 */
function getGalleryInformation ()
{
    $db = connectToDB();
    
    $galleries = new GalleryDB ($db);
    
    $results = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $galleries -> findByID($_GET['id']) : $galleries -> findByID(29);
    
    outputGalleryInformation($results);

    echo '<h3 class="ui dividing header">Paintings</h3>';
    
    outputGalleryPaintings($galleries);
    
    $db = null;
}

/**
 * Outputs all the related information about a single gallery
 * @param results The results set
 */ 
function outputGalleryInformation ($results)
{
    foreach ($results as $row)
    {
        echo '<h2 class="ui horizontal divider header">' . $row['GalleryName'] . '</h2>';
        echo '<div class="ui message">';
        echo '<div class="ui grid">';
        echo '<div class="four wide column">';
        echo '<div class="ui relaxed list">';
        
        echo '<div class="item">';
        echo '<i class="building icon"></i>';
        echo '<div class="content">';
        echo '<div class="header">Gallery Native Name</div>';
        echo $row['GalleryNativeName'];
        echo '</div>'; // content
        echo '</div>'; // item
        
        echo '<div class="item">';
        echo '<i class="marker icon"></i>';
        echo '<div class="content">';
        echo '<div class="header">Location</div>';
        echo $row['GalleryCity'] . ', ' . $row['GalleryCountry'];
        echo '</div>'; // content
        echo '</div>'; // item
        
        echo '<div class="item">';
        echo '<i class="linkify icon"></i>';
        echo '<div class="content">';
        echo '<div class="header">Website</div>';
        echo '<a href="' . $row['GalleryWebsite'] . '" target="_blank">' . $row['GalleryWebsite'] . '</a>';
        echo '</div>'; // content
        echo '</div>'; // item
        
        echo '</div>'; // ul list
        echo '</div>'; // four wide column
        echo '<div class="twelve wide column">';
        echo '<div id="map"></div>';
        
        outputGoogleMap ($row);
        echo '</div>'; // twelve wide column
        echo '</div>'; // ui grid
        echo '</div>'; // ui message
    }
}

/**
 * Outputs the location on Google Maps for a gallery
 * @param row The row location in the table for the latitude and longitude
 */ 
function outputGoogleMap ($row)
{
    echo '<script>';
    echo 'function initMap() {';
    echo 'var uluru = { lat: '. $row['Latitude'] . ', lng: ' . $row['Longitude'] . '};';
    echo 'var map = new google.maps.Map(document.getElementById("map"), {';
    echo 'zoom: 18,';
    echo 'center: uluru,';
    echo 'scrollwheel: false';
    echo '});';
    echo 'var marker = new google.maps.Marker({';
    echo 'position: uluru,';
    echo 'map: map';
    echo '});';
    echo '}';
    echo '</script>';
}

/**
 * Outputs all paintings that are in a specific gallery
 * @param galleries The galleries object
 */ 
function outputGalleryPaintings ($galleries)
{
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $galleries -> findByPainting($_GET['id']) : $galleries -> findByPainting(29);
    
    $results = $galleries -> getAll($sql);
    
    outputPaintingsPanel($results);
}

?>