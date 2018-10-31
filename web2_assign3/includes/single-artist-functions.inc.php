<?php

/*
 * ==============================================================
 * |                                                            |
 * |                    SINGLE-ARTIST PAGE                      |
 * |                                                            |
 * ==============================================================
 */
 
/**
 * Gets the artist information for a specfic artist
 */ 
function getArtistInformation ()
{
    $db = connectToDB();
    
    $artists = new ArtistDB ($db);
    
    $results = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $artists -> findByID($_GET['id']) : header('Location: '.'single-artist.php?id=1');
    
    
    echo '<div class="ui message">';
    echo '<div class="ui container">';
    echo '<div class="ui items">';
    
    outputArtistInformation($results);
    
    echo '</div>'; // ui items
    echo '</div>'; // ui container
    echo '</div>'; // ui message
    
    echo '<section class="ui container">';
    echo '<h3 class="ui dividing header">Paintings</h3>';
    
    outputArtistPaintings($artists);
    
    echo '</section>';
    
    $db = null;
}

/**
 * Outputs all the artist information about a specfic artist
 * @param results The result set
 */ 
function outputArtistInformation ($results)
{
    foreach ($results as $row)
    {
        echo '<div class="item">';
        echo '<div class="image">';
        echo '<img src="images/art/artists/square-medium/' . $row['ArtistID'] . '.jpg" alt="..." title="' . $row['FirstName'] . ' ' .$row['LastName'] . '" />';
        echo '</div>'; // image
        echo '<div class="content">';
        echo '<h1 class="ui header">' . $row['FirstName'] . ' ' . $row['LastName'] . '</h1>';
        
        favButton('aid', 'favArtists');
        
        echo '<div class="description">';
        
        echo '<div class="ui top attached tabular menu ">';
        echo '<a class="active item" data-tab="details"><i class="image icon"></i>Artists Details</a>';
        echo '<a class="item" data-tab="info"><i class="info circle icon"></i>Artist Info</a>';
        echo '</div>';
        
        echo '<div class="ui bottom attached active tab segment" data-tab="details">';
        echo '<p>' . $row['Details'] . '</p>';
        echo '</div>';
        
        echo '<div class="ui bottom attached tab segment" data-tab="info">';
        
        outputArtistInfoTab($row);
        
        echo '</div>'; // ui bottom attached tab segment
        echo '</div>'; // description
        echo '</div>'; // content

        echo '</div>'; // item
    }
}

/**
 * Outputs the artist info tab that contains their YOB, YOD, Nationality, Gender, and their Wikipedia link
 * @param row The row location that each information is located at
 */ 
function outputArtistInfoTab ($row)
{
    echo '<table class="ui definition very basic collapsing celled table">';
    echo '<tbody>';
    echo '<tr>';
    echo '<td>Year of Birth</td>';
    echo '<td>' . $row['YearOfBirth'] . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Year of Death</td>';
    echo '<td>' . $row['YearOfDeath'] . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Nationality:</td>';
    echo '<td>' . $row['Nationality'] . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Gender:</td>';
    echo '<td>' . $row['Gender'] . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Artist Link:</td>';
    echo '<td><a href="' . $row['ArtistLink'] . '" target="_blank">'. $row['ArtistLink'] .'</a></td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
}

/**
 * Outputs all the related paintings done by a specfic artist
 * @param artists The artist object
 */ 
function outputArtistPaintings ($artists)
{
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $artists -> findByArtist($_GET['id']) : $artists -> findByArtist(1);

    $results = $artists -> getAll($sql);
    
    outputPaintingsPanel($results);
}

?>