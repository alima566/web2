<?php
/*
 * ==============================================================
 * |                       FUNCTIONS USED                       |
 * |                      ON MULTIPLE PAGES                     |
 * |                                                            |
 * ==============================================================
 */
function connectToDB ()
{
    try
    {
        $connString = 'mysql:host=localhost; dbname=art; charset=utf8';
        
        $user = 'alima566';
        $password = '';
          
        $pdo = new PDO($connString, $user, $password);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $err)
    {
        die($err -> getMessage());
    }
    return $pdo;
} 

function getStatement ($db, $sql, $bindValueParam, $id)
{
    $statement = $db -> prepare($sql);
    $statement -> bindValue($bindValueParam, $id);
    $statement -> execute();
      
    return $statement;
}

function outputPaintingsPanel ($db, $sql, $id, $bindValueParam)
{
    $statement = getStatement ($db, $sql, $bindValueParam, $id);
    
    echo '<div class="ui small images">';
    while ($row = $statement -> fetch())
    {
        echo '<a href="single-painting.php?id=' . $row['PaintingID'] . '">';
        echo '<img src="images/art/works/square-medium/' . $row['ImageFileName'] . '.jpg" alt="..." title="' . $row['Title'] . '" /></a>';
    }
    echo '</div>';
    
    $db = null;
}

/*
 * ==============================================================
 * |                                                            |
 * |                    BROWSE-GENRES PAGE                      |
 * |                                                            |
 * ==============================================================
 */
function outputAllGenres ()
{
    $db = connectToDB();
    
    $sql = 'SELECT GenreID, GenreName
            FROM Genres
            ORDER BY EraID, GenreName';
            
    $results = $db -> query($sql);
    
    while ($row = $results -> fetch())
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

/*
 * ==============================================================
 * |                                                            |
 * |                     SINGLE-GENRE PAGE                      |
 * |                                                            |
 * ==============================================================
 */
function getGenreInformation ()
{
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $genreID = $_GET['id'];
            
        $sql = 'SELECT GenreID, GenreName, Description 
                FROM Genres 
                WHERE GenreID = :genreID';
        
        outputGenreInformation(connectToDB(), $sql, $genreID, ':genreID');
    }
    else 
    {
        $sql = 'SELECT GenreID, GenreName, Description 
                FROM Genres 
                WHERE GenreID = 33';
        
        outputGenreInformation(connectToDB(), $sql, 33, 33);
    }
}

function outputGenreInformation ($db, $sql, $id, $bindValueParam)
{
    $statement = getStatement ($db, $sql, $bindValueParam, $id);
        
    while ($row = $statement -> fetch())
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
    
    $db = null;
}

function outputGenrePaintings ()
{
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $genreID = $_GET['id'];
        
        $sql = 'SELECT Paintings.PaintingID, Paintings.ImageFileName, Paintings.Title 
                FROM Paintings NATURAL JOIN PaintingGenres
                JOIN Genres USING (GenreID)
                WHERE Genres.GenreID = :genreID
                ORDER BY Paintings.YearOfWork';
        
        outputPaintingsPanel(connectToDB(), $sql, $genreID, ':genreID');
    }
    else
    {
        $sql = 'SELECT Paintings.PaintingID, Paintings.ImageFileName, Paintings.Title 
                FROM Paintings NATURAL JOIN PaintingGenres
                JOIN Genres USING (GenreID)
                WHERE Genres.GenreID = 33
                ORDER BY Paintings.YearOfWork';
        
        outputPaintingsPanel(connectToDB(), $sql, 33, 33);
    }
}

/*
 * ==============================================================
 * |                                                            |
 * |                    SINGLE-ARTIST PAGE                      |
 * |                                                            |
 * ==============================================================
 */
function getArtistInformation ()
{
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $artistID = $_GET['id'];
            
        $sql = 'SELECT ArtistID, FirstName, LastName, Details, YearOfBirth, YearOfDeath
                FROM Artists 
                WHERE ArtistID = :artistID';
        
        outputArtistInformation(connectToDB(), $sql, $artistID, ':artistID');
    }
    else
    {
        $sql = 'SELECT ArtistID, FirstName, LastName, Details, YearOfBirth, YearOfDeath
                FROM Artists
                WHERE ArtistID = 1';
        
        outputArtistInformation(connectToDB(), $sql, 1, 1);
    }
}

function outputArtistInformation ($db, $sql, $id, $bindValueParam)
{
    $statement = getStatement ($db, $sql, $bindValueParam, $id);
        
    while ($row = $statement -> fetch())
    {
        echo '<div class="item">';
        echo '<div class="image">';
        echo '<img src="images/art/artists/square-medium/' . $row['ArtistID'] . '.jpg" alt="..." title="' . $row['FirstName'] . ' ' .$row['LastName'] . '" />';
        echo '</div>'; // image
        echo '<div class="content">';
        echo '<h1 class="ui header">' . $row['FirstName'] . ' ' . $row['LastName'] . '</h1>';
        echo '<div class="meta">' . $row['YearOfBirth'] . ' - ' . $row['YearOfDeath'] . '</div>';
        echo '<div class="description">';
        echo '<p>' . $row['Details'] . '</p>';
        echo '</div>'; // description
        echo '</div>'; // content
        echo '</div>'; // item
    }
    
    $db = null;
}

function outputArtistPaintings ()
{
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $artistID = $_GET['id'];
        
        $sql = 'SELECT Paintings.PaintingID, Paintings.ImageFileName, Paintings.Title
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.ArtistID = :artistID
                ORDER BY Paintings.YearOfWork';
                    
        outputPaintingsPanel(connectToDB(), $sql, $artistID, ':artistID');
    }
    else
    {
        $sql = 'SELECT Paintings.PaintingID, Paintings.ImageFileName, Paintings.Title
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.ArtistID = 1
                ORDER BY Paintings.YearOfWork';
                    
        outputPaintingsPanel(connectToDB(), $sql, 1, 1);
    }
}

/*
 * ==============================================================
 * |                                                            |
 * |                    BROWSE-PAINTINGS PAGE                   |
 * |                                                            |
 * ==============================================================
 */
function outputPaintings ($db, $sql)
{
    $results = $db -> query($sql);
      
    while ($row = $results -> fetch())
    {
      echo '<div class="item">';
      echo '<div class="image">';
      echo '<img src="images/art/works/square-medium/' . $row['ImageFileName'] . '.jpg" alt="..." title="' . $row['Title']. '"/>';
      echo '</div>'; //image
      echo '<div class="content">';
      echo '<a href="single-painting.php?id=' . $row['PaintingID'] . '" class="header">' . $row['Title']. '</a>';
      echo '<div class="meta">';
      echo '<span>' . $row['FirstName'] . ' ' . $row['LastName'] . '</span>';
      echo '</div>'; // meta
      echo '<div class="description">';
      echo '<p>' . $row['Description'] . '</p>';
      echo '<p>$' . number_format($row['MSRP']) . '</p>';
      
      echo '<button class="ui compact icon orange button">';
      echo '<i class="shop icon"></i>';
      echo '</button>';
        
      echo '<button class="ui compact icon button">';
      echo '<i class="heart icon"></i>';
      echo '</button>';
        
      echo '</div>'; // description
      echo '</div>'; // content
      echo '</div>'; // item
        
      echo '<div class="ui divider"></div>';
    }
    
    $db = null;
}

function filterSearch ()
{
    $db = connectToDB();
    
    $artistID = $_GET['artist'];
    $museumID = $_GET['museum'];
    $shapeID = $_GET['shape'];
    
    if (empty($artistID) && empty($museumID) && empty($shapeID))
    {
      $sql = 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
              FROM Paintings NATURAL JOIN Artists
              ORDER BY Paintings.YearOfWork LIMIT 20';
      
      echo '<h4 class="ui header">ALL PAINTINGS [TOP 20]</h4>';
      outputPaintings($db, $sql);
    }
    else
    {
      getFilteredSearchResults($artistID, $museumID, $shapeID);
    }
    
    $db = null;
}

function getFilteredSearchResults ($artistID, $museumID, $shapeID)
{
    if (isset($artistID))
    {
        $sql = 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.ArtistID = ' . $artistID . '
                ORDER BY Paintings.YearOfWork';
    
        outputPaintings(connectToDB(), $sql);
    }
    if (isset($museumID))
    {
        $sql = 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                JOIN Galleries
                ON Paintings.GalleryID = Galleries.GalleryID
                WHERE Paintings.GalleryID = ' . $museumID . '
                ORDER BY Galleries.GalleryName';
            
        outputPaintings(connectToDB(), $sql);
    }
    if (isset($shapeID))
    {
        $sql = 'SELECT Paintings.PaintingID, Paintings.Title, Paintings.Description, Paintings.MSRP, Paintings.ImageFileName, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                JOIN Shapes
                ON Paintings.ShapeID = Shapes.ShapeID
                WHERE Paintings.ShapeID = ' . $shapeID . '
                ORDER BY Paintings.YearOfWork';
    
        outputPaintings(connectToDB(), $sql);
    }
}

function artistDropdownList ()
{
    $db = connectToDB();
    
    $sql = 'SELECT ArtistID, FirstName, LastName
            FROM Artists ORDER BY LastName'; 
    
    $results = $db -> query($sql);
    while ($row = $results -> fetch())
    {
      $artistName = $row['FirstName'] . ' ' . $row['LastName'];
      outputDropdownLists($row['ArtistID'], $artistName);
    }
    
    $db = null;
}

function museumDropdownList ()
{
    $db = connectToDB();
      
    $sql = 'SELECT GalleryID, GalleryName
            FROM Galleries ORDER BY GalleryName';
    
    $results = $db -> query($sql);
    while ($row = $results -> fetch())
    {
      outputDropdownLists($row['GalleryID'], $row['GalleryName']);
    }
    
    $db = null;
}

function shapeDropdownList ()
{
    $db = connectToDB();
      
    $sql = 'SELECT ShapeID, ShapeName
            FROM Shapes ORDER BY ShapeName';
    
    $results = $db -> query($sql);
    while ($row = $results -> fetch())
    {
      outputDropdownLists($row['ShapeID'], $row['ShapeName']);
    }
    
    $db = null;
}

function outputDropdownLists ($id, $name)
{
    echo '<option class="item" value="' . $id . '">' . $name . '</option>';
}

/*
 * ==============================================================
 * |                                                            |
 * |                     SINGLE-PAINTING PAGE                   |
 * |                                                            |
 * ==============================================================
 */
function retrieveFrameOptions ()
{   
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $sql = 'SELECT DISTINCT TypesFrames.Title
                FROM TypesFrames NATURAL JOIN OrderDetails
                JOIN Paintings USING (PaintingID)
                WHERE Paintings.PaintingID = :paintingID';
                
        outputSelectLists(connectToDB(), $sql, ':paintingID',$_GET['id']);
    }
    else
    {
        $sql = 'SELECT DISTINCT TypesFrames.Title
                FROM TypesFrames NATURAL JOIN OrderDetails
                JOIN Paintings USING (PaintingID)
                WHERE Paintings.PaintingID = 420';
                
        outputSelectLists(connectToDB(), $sql, 420, 420);
    }
}

function retrieveGlassOptions ()
{
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $sql = 'SELECT DISTINCT TypesGlass.Title
                FROM TypesGlass NATURAL JOIN OrderDetails
                JOIN Paintings USING (PaintingID)
                WHERE Paintings.PaintingID = :paintingID';
          
        outputSelectLists(connectToDB(), $sql, ':paintingID', $_GET['id']);
    }
    else
    {
        $sql = 'SELECT DISTINCT TypesGlass.Title
                FROM TypesGlass NATURAL JOIN OrderDetails
                JOIN Paintings USING (PaintingID)
                WHERE Paintings.PaintingID = 420';
          
        outputSelectLists(connectToDB(), $sql, 420, 420);
    }
}

function retrieveMattOptions ()
{
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $sql = 'SELECT DISTINCT TypesMatt.Title
                FROM TypesMatt NATURAL JOIN OrderDetails
                JOIN Paintings USING (PaintingID)
                WHERE Paintings.PaintingID = :paintingID';
              
        outputSelectLists(connectToDB(), $sql, ':paintingID', $_GET['id']);
    }
    else
    {
        $sql = 'SELECT DISTINCT TypesMatt.Title
                FROM TypesMatt NATURAL JOIN OrderDetails
                JOIN Paintings USING (PaintingID)
                WHERE Paintings.PaintingID = 420';
              
        outputSelectLists(connectToDB(), $sql, 420, 420);
    }
}

function outputSelectLists ($db, $sql, $bindValueParam, $paintingID)
{
    $statement = getStatement ($db, $sql, $bindValueParam, $paintingID);
      
    while ($row = $statement -> fetch())
    {
      echo '<option>' . $row['Title'] . '</option>';
    }
    
    $db = null;
} 

function outputDescriptionTab ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
      $paintingID = $_GET['id'];
      
      $sql = 'SELECT Description
              FROM Paintings
              WHERE PaintingID = :paintingID';
              
      $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
      $sql = 'SELECT Description
              FROM Paintings
              WHERE PaintingID = 420';
              
      $statement = getStatement ($db, $sql, 420, 420);  
    }
    
    while ($row = $statement -> fetch())
    {
      echo $row['Description'];
    }
    
    $db = null;
} 

function outputReviewsTab ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $paintingID = $_GET['id'];
      
        $sql = 'SELECT Reviews.Comment, Reviews.ReviewDate, Reviews.Rating
                FROM Reviews NATURAL JOIN Paintings
                WHERE Paintings.PaintingID = :paintingID';
              
        $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
        $sql = 'SELECT Reviews.Comment, Reviews.ReviewDate, Reviews.Rating
                FROM Reviews NATURAL JOIN Paintings
                WHERE Paintings.PaintingID = 420';
              
        $statement = getStatement ($db, $sql, 420, 420);
    }
    
    while ($row = $statement -> fetch())
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

function outputPainting ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
      $paintingID = $_GET['id'];
      
      $sql = 'SELECT ImageFileName, Description, Title
              FROM Paintings
              WHERE PaintingID = :paintingID';
              
      $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
      $sql = 'SELECT ImageFileName, Description, Title
              FROM Paintings
              WHERE PaintingID = 420';
              
      $statement = getStatement ($db, $sql, 420, 420);
    }
    
    echo '<div class="nine wide column">';
    while ($row = $statement -> fetch())
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

function outputPaintingInfo ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $paintingID = $_GET['id'];
      
        $sql = 'SELECT Paintings.Title, Paintings.Excerpt, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.PaintingID = :paintingID';
      
        $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
        $sql = 'SELECT Paintings.Title, Paintings.Excerpt, Artists.FirstName, Artists.LastName
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.PaintingID = 420';
      
        $statement = getStatement ($db, $sql, 420, 420);
    }
    
    while ($row = $statement -> fetch())
    {
        echo '<div class="item">';
        echo '<h2 class="header">' . $row['Title']. '</h2>';
        echo '<h3>' . $row['FirstName'] . ' ' . $row['LastName'] . '</h3>';
        echo '<div class="meta">';
        echo '<p>';
        echo '<i class="orange star icon"></i>';
        echo '<i class="orange star icon"></i>';
        echo '<i class="orange star icon"></i>';
        echo '<i class="orange star icon"></i>';
        echo '<i class="empty star icon"></i>';
        echo '</p>';
        echo '<p>' . $row['Excerpt'] . '</p>';
        echo '</div>'; // .meta
        echo '</div>'; // .item
    }
    
    $db = null;
}

function outputDetailsTab ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $paintingID = $_GET['id'];
      
        $sql = 'SELECT Artists.ArtistID, Artists.FirstName, Artists.LastName, Paintings.YearOfWork, Paintings.Height, Paintings.Width, Paintings.Medium
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.PaintingID = :paintingID';
      
        $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
        $sql = 'SELECT Artists.ArtistID, Artists.FirstName, Artists.LastName, Paintings.YearOfWork, Paintings.Height, Paintings.Width, Paintings.Medium
                FROM Paintings NATURAL JOIN Artists
                WHERE Paintings.PaintingID = 420';
      
        $statement = getStatement ($db, $sql, 420, 420);
    }
    
    while ($row = $statement -> fetch())
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

function outputMuseumTab ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $paintingID = $_GET['id'];
      
        $sql = 'SELECT Galleries.GalleryName, Paintings.AccessionNumber, Paintings.CopyrightText, Galleries.GalleryWebSite
                FROM Paintings NATURAL JOIN Galleries
                WHERE Paintings.PaintingID = :paintingID';
      
        $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
        $sql = 'SELECT Galleries.GalleryName, Paintings.AccessionNumber, Paintings.CopyrightText, Galleries.GalleryWebSite
                FROM Paintings NATURAL JOIN Galleries
                WHERE Paintings.PaintingID = 420';
      
        $statement = getStatement ($db, $sql, 420, 420);
    }
    
    while ($row = $statement -> fetch())
    {
        echo '<tr>';
        echo '<td>Museum</td>';
        echo '<td>' . $row['GalleryName'] . '</td>';
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
        echo '<td><a href="' . $row['GalleryWebSite']. '">View painting at museum site</a></td>';
        echo '</tr>';       
    }
    
    $db = null;
}

function outputGenresTab ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $paintingID = $_GET['id'];
      
        $sql = 'SELECT Genres.GenreName, Genres.GenreID
                FROM Genres NATURAL JOIN PaintingGenres
                WHERE PaintingGenres.PaintingID = :paintingID';
      
        $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
        $sql = 'SELECT Genres.GenreName, Genres.GenreID
                FROM Genres NATURAL JOIN PaintingGenres
                WHERE PaintingGenres.PaintingID = 420';
      
        $statement = getStatement ($db, $sql, 420, 420);
    }
    
    echo '<ul class="ui list">';
    while ($row = $statement -> fetch())
    {
        echo '<li class="item"><a href="single-genre.php?id=' . $row['GenreID'] . '">' . $row['GenreName'] . '</a></li>';
    }
    echo '</ul>';
    
    $db = null;
}

function outputSubjectsTab ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $paintingID = $_GET['id'];
      
        $sql = 'SELECT Subjects.SubjectName, Subjects.SubjectID
                FROM Subjects NATURAL JOIN PaintingSubjects
                WHERE PaintingSubjects.PaintingID = :paintingID';
      
        $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
        $sql = 'SELECT Subjects.SubjectName, Subjects.SubjectID
                FROM Subjects NATURAL JOIN PaintingSubjects
                WHERE PaintingSubjects.PaintingID = 420';
      
        $statement = getStatement ($db, $sql, 420, 420);
    }
    
    echo '<ul class="ui list">';
    while ($row = $statement -> fetch())
    {
        echo '<li class="item"><a href="#">' . $row['SubjectName'] . '</a></li>';
    }
    echo '</ul>';
    
    $db = null;
}

function outputOnTheWebTab ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $paintingID = $_GET['id'];
    
        $sql = 'SELECT WikiLink, GoogleLink, GoogleDescription
                FROM Paintings
                WHERE PaintingID = :paintingID';
      
        $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
        $sql = 'SELECT WikiLink, GoogleLink, GoogleDescription
                FROM Paintings
                WHERE PaintingID = 420';
      
        $statement = getStatement ($db, $sql, 420, 420);
    }
    
    while ($row = $statement -> fetch())
    {
        echo '<tr>';
        echo '<td>Wikipedia Link</td>';
        echo '<td><a href="' . $row['WikiLink'] . '">View painting on Wikipedia</a></td>';                       
        echo '</tr>';                       
            
        echo '<tr>';
        echo '<td>Google Link</td>';
        echo '<td><a href="' . $row['GoogleLink'] . '">View painting on Google Art Project</a></td>';              
        echo '</tr>';
                    
        echo '<tr>';
        echo '<td>Google Text</td>';
        echo '<td>' . $row['GoogleDescription'] . '</td>';                 
        echo '</tr>';
    }
    
    $db = null;
}  

function getCost ()
{
    $db = connectToDB();
    
    if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id'])))
    {
        $paintingID = $_GET['id'];
      
        $sql = 'SELECT MSRP
                FROM Paintings
                WHERE PaintingID = :paintingID';
      
        $statement = getStatement ($db, $sql, ':paintingID', $paintingID);
    }
    else
    {
        $sql = 'SELECT MSRP
                FROM Paintings
                WHERE PaintingID = 420';
      
        $statement = getStatement ($db, $sql, 420, 420);
    }
    
    while ($row = $statement -> fetch())
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
 */
function convertToDate ($stringToConvert)
{
    return date('m/d/Y', strtotime($stringToConvert));
}

/**
 * Generates the stars for the reviews tab
 */
function generateStars ($numStars)
{
	for ($i = 0; $i < 5; $i++)
	{
	    $stars .= ($i >= $numStars) ? '<i class="star icon"></i>' : '<i class="orange star icon"></i>';
	}
	return $stars;
}
?>