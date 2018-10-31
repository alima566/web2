<?php

/*
 * ==============================================================
 * |                                                            |
 * |                     SINGLE-PAINTING PAGE                   |
 * |                                                            |
 * ==============================================================
 */

/**
 * Displays the "Add to Cart Button" for the painting
 */
function cartButton ()
{
    echo '<button name="cartItem" class="ui labeled icon orange button">';
    echo '<i class="add to cart icon"></i>';
    echo 'Add to Cart';
    echo '</button>';
}

/**
 * Outputs the description tab for a single painting
 */
function outputDescriptionTab ()
{
    $db = connectToDB();
    
    $paintings = new PaintingDB ($db);
    
    $results = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $paintings -> findByID($_GET['id']) : $paintings -> findByID(420);
    
    foreach ($results as $row)
    {
        echo $row['Description'];
    }
    
    $db = null;
} 

/**
 * Outputs the reviews tab for a single painting
 */
function outputReviewsTab ()
{
    $db = connectToDB();
    
    $reviews = new ReviewDB ($db);
    
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $reviews -> findByPaintingID($_GET['id']) : $reviews -> findByPaintingID(420);
    
    $results = $reviews -> getAll($sql);
    
    foreach ($results as $row)
    {
        echo '<div class="event">';
        echo '<div class="content">';
        echo '<div class="date">' . convertToDate($row['ReviewDate']) . '</div>';
        echo '<div class="meta">';
        echo '<a class="like">' . generateStars($row['Rating']) . '</a>';
        echo '</div>'; // meta                
        echo '<div class="summary">' . $row['Comment'] . '</div>';
        echo '</div>'; // content
        echo '</div>'; // event
        echo '<div class="ui divider"></div>';
    }
    
    $db = null;
}

/**
 * Outputs the image of a single painting along with the modal image
 */
function outputPainting ()
{
    $db = connectToDB();
    
    $paintings = new PaintingDB ($db);
    
    $results = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $paintings -> findByID($_GET['id']) : $paintings -> findByID(420);
    
    echo '<div class="nine wide column">';
    foreach ($results as $row)
    {
        echo '<img src="images/art/works/medium/' . $row['ImageFileName'] . '.jpg" alt="..." class="ui big image" id="artwork" title="' . $row['Title'] . '">';
        echo '<div class="ui fullscreen modal">';
        echo '<div class="image content">';
        echo '<img src="images/art/works/large/' . $row['ImageFileName'] . '.jpg" alt="..." class="image" >';
        echo '<div class="description">';
        echo '<p></p>';
        echo '</div>'; // description
        echo '</div>'; // image content
        echo '</div>'; // ui fullscreen modal
    }
    echo '</div>'; // nine wide column
  
    $db = null;
}

/**
 * Outputs information about a single painting
 */
function outputPaintingInfo ()
{
    $db = connectToDB();
    
    $paintings = new PaintingDB ($db);
    
    $id = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $_GET['id'] : 420;
    $results = (isset($id) && !empty($id) && ctype_digit(strval($id))) ? $paintings -> findByID($id) : header('Location: '.'single-painting.php?id=420');
    
    foreach ($results as $row)
    {
        echo '<div class="item">';
        echo '<h2 class="header">' . $row['Title']. '</h2>';
        echo '<h3>' . $row['FirstName'] . ' ' . $row['LastName'] . '</h3>';
        echo '<div class="meta">';
        echo '<p>';
        echo generateStars(calculateAvgRating($db, $id));
        echo '</p>';
        echo '<p>' . $row['Excerpt'] . '</p>';
        echo '</div>'; // .meta
        echo '</div>'; // .item
    }
    
    $db = null;
}

/**
 * Calculates the average rating for a single painting
 * @param db The database object
 * @param paintingID The painting ID for a single painting
 * @return The average rating for a single painting, rounded up
 */
function calculateAvgRating ($db, $paintingID)
{
    $reviews = new ReviewDB ($db);
    
    $sql = $reviews -> findByPaintingID($paintingID);
    $results = $reviews -> getAll($sql);
    foreach ($results as $row)
    {
        $sum = intval($row['Rating']) + $sum;
        
        $sqlRows = $reviews -> getCount($paintingID); 
        
        $results2 = $reviews -> getAll($sqlRows);
        
        foreach($results2 as $row2)
        {
            $numRows = intval($row2['COUNT(Reviews.Rating)']);
        }
    }
    $avg = ($numRows == 0) ? 0 : ($sum/$numRows);
    return ceil($avg);
}

/**
 * Outputs the details tab for a single painting
 */
function outputDetailsTab ()
{
    $db = connectToDB();
    
    $paintings = new PaintingDB ($db);
    
    $results =  (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $paintings -> findByID($_GET['id']) : $paintings -> findByID(420);
    
    foreach ($results as $row)
    {
        echo '<tr>';
        echo '<td>Artist</td>';
        echo '<td>';
        echo '<a href="single-artist.php?id=' . $row['ArtistID'] . '">' . $row['FirstName'] . ' ' . $row['LastName'] . '</a>';
        echo '</td>';
        echo '</tr>';
        
        echo '<tr>';
        echo '<td>Year</td>';
        echo '<td>' . $row['YearOfWork'] . '</td>';
        echo '</tr>';
      
        echo '<tr>';
        echo '<td>Medium</td>';
        echo '<td>' . $row['Medium'] . '</td>';
        echo '</tr>';  
      
        echo '<tr>';
        echo '<td>Dimensions</td>';
        echo '<td>' . $row['Width'] . 'cm x ' . $row['Height'] . 'cm</td>';
        echo '</tr>';       
    }
    
    $db = null;
}

/**
 * Outputs the museum tab for a single painting
 */
function outputMuseumTab ()
{
    $db = connectToDB();
    
    $paintings = new PaintingDB ($db);
    
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $paintings -> getMuseum($_GET['id']) : $paintings -> getMuseum(420);

    $results = $paintings -> getAll($sql);
    
    foreach ($results as $row)
    {
        echo '<tr>';
        echo '<td>Museum</td>';
        echo '<td><a href="single-gallery.php?id=' . $row[GalleryID] . '">' . $row['GalleryName'] . '</a></td>';
        echo '</tr>';
      
        echo '<tr>';
        echo '<td>Accession #</td>';
        echo '<td>' . $row['AccessionNumber'] . '</td>';
        echo '</tr>';
      
        echo '<tr>';
        echo '<td>Copyright</td>';
        echo '<td>' . $row['CopyrightText'] . '</td>';
        echo '</tr>';  
        
        echo '<tr>';
        echo '<td>URL</td>';
        echo '<td><a href="' . $row['GalleryWebSite']. '" target="_blank">View painting at museum site</a></td>';
        echo '</tr>';       
    }
    
    $db = null;
}

/**
 * Outputs the genres tab for a single painting
 */
function outputGenresTab ()
{
    $db = connectToDB();
    
    $genres = new GenreDB ($db);
    
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $genres -> findByPaintingGenre($_GET['id']) : $genres -> findByPaintingGenre(420);
    
    $results = $genres -> getAll($sql);

    echo '<ul class="ui list">';
    foreach ($results as $row)
    {
        echo '<li class="item"><a href="single-genre.php?id=' . $row['GenreID'] . '">' . $row['GenreName'] . '</a></li>';
    }
    echo '</ul>';
    
    $db = null;
}

/**
 * Outputs the subjects tab for a single painting
 */
function outputSubjectsTab ()
{
    $db = connectToDB();
    
    $subjects = new SubjectDB ($db);
    
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $subjects -> findByPaintingSubject($_GET['id']) : $subjects -> findByPaintingSubject(420);

    $results = $subjects -> getAll($sql);
    
    echo '<ul class="ui list">';
    foreach ($results as $row)
    {
        echo '<li class="item"><a href="single-subject.php?id=' . $row['SubjectID'] . '">' . $row['SubjectName'] . '</a></li>';
    }
    echo '</ul>';
    
    $db = null;
}

/**
 * Outputs the on the web tab for a single painting
 */
function outputOnTheWebTab ()
{
    $db = connectToDB();
    
    $paintings = new PaintingDB ($db);
    
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $paintings -> getLinks($_GET['id']) : $paintings -> getLinks(420);
    
    $results = $paintings -> getAll($sql);
    
    foreach ($results as $row)
    {
        echo '<tr>';
        echo '<td>Wikipedia Link</td>';
        echo '<td><a href="' . $row['WikiLink'] . ' " target="_blank">View painting on Wikipedia</a></td>';                       
        echo '</tr>';                       
            
        echo '<tr>';
        echo '<td>Google Link</td>';
        echo '<td><a href="' . $row['GoogleLink'] . '" target="_blank">View painting on Google Art Project</a></td>';              
        echo '</tr>';
                    
        echo '<tr>';
        echo '<td>Google Text</td>';
        echo '<td>' . $row['GoogleDescription'] . '</td>';                 
        echo '</tr>';
    }
    
    $db = null;
}  

/**
 * Gets the cost of a single painting
 */
function getCost ()
{
    $db = connectToDB();
    
    $paintings = new PaintingDB ($db);
    
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $paintings -> getCost($_GET['id']) : $paintings -> getCost(420);

    $results = $paintings -> getAll($sql);
    
    foreach ($results as $row)
    {
        echo '<div class="ui tiny statistic">';
        echo '<div class="value">';
        echo '$' . number_format($row['MSRP']);
        echo '</div>';
        echo '</div>';
    }
    
    $db = null;
}

/**
 * Converts a string to a date format for the reviews tab
 * @param stringToConvert The string to convert into a date format
 * @return The formatted date
 */
function convertToDate ($stringToConvert)
{
    return date('m/d/Y', strtotime($stringToConvert));
}

/**
 * Generates the stars for the reviews tab
 * @param numStars The number of stars a single painting has
 * @param stars The total stars (yellow and white) a single painting has out of five
 */
function generateStars ($numStars)
{
	for ($i = 0; $i < 5; $i++)
	{
	    $stars .= ($i >= $numStars) ? '<i class="empty star icon"></i>' : '<i class="orange star icon"></i>';
	}
	return $stars;
}

?>