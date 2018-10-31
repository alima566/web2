<?php

/*
 * ==============================================================
 * |                                                            |
 * |                     BROWSE-SUBJECTS PAGE                   |
 * |                                                            |
 * ==============================================================
 */
 
/**
 * Outputs all the subjects, sorted by subject name
 */
function outputSubjects ()
{
    $db = connectToDB();
    
    $subjects = new SubjectDB ($db);
    $results = $subjects -> getAll(null);
    
    foreach ($results as $row)
    {
        echo '<div class="ui fluid card">';
        echo '<a class="image" href="single-subject.php?id=' . $row['SubjectID'] . '" class="ui medium image">';
        echo '<img src="images/art/subjects/square-medium/' . $row['SubjectID'] . '.jpg" alt="..." title="' . $row['SubjectName'] . '"/></a>';
        echo '<div class="content">';
        echo '<h4 class="ui header">';
        echo '<a class="header" href="single-subject.php?id=' . $row['SubjectID'] . '">' . $row['SubjectName'] . '</a>';
        echo '</h4>';
        echo '</div>'; // content
        echo '</div>'; // ui card
    }
    
    $db = null;
}

?>