<?php

/*
 * ==============================================================
 * |                                                            |
 * |                   SINGLE-SUBJECT PAGE                      |
 * |                                                            |
 * ==============================================================
 */

/**
 * Gets information about a single subject
 */
function getSubjectInformation ()
{
    $db = connectToDB();
    
    $subjects = new SubjectDB ($db);
    
    $results = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $subjects -> findByID($_GET['id']) : $subjects -> findByID(11);
    
    outputSubjectInformation($results);
    
    echo '<h3 class="ui dividing header">Paintings</h3>';
    
    outputSubjectPaintings($subjects);
    
    $db = null;
}

/**
 * Outputs information about a single subject
 * @param results The results set
 */
function outputSubjectInformation ($results)
{
    foreach ($results as $row)
    {
        echo '<h1 class="ui center aligned block icon header">';
        echo '<img class="ui circular image" src="images/art/subjects/square-medium/' . $row['SubjectID'] . '.jpg">';
        echo '<div class="content">' . $row['SubjectName'] . '</div></h1>';
    }
}

/**
 * Outputs all the paintings related to a single subject
 * @param subjects The subject object
 */
function outputSubjectPaintings ($subjects)
{
    $sql = (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit(strval($_GET['id']))) ? $subjects -> findBySubject($_GET['id']) : $subjects -> findBySubject(11);
    
    $results = $subjects -> getAll($sql);
    
    outputPaintingsPanel($results);
}

?>