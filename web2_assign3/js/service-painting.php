<?php
require 'includes/functions.inc.php';
include 'includes/browse-paintings-functions.inc.php';

    $db = connectToDB();
    $painting = new PaintingDB ($db);
    //$service = new ServicePaintingDB ();
    
    if (isset($_GET['search']) && !empty($_GET['search']))
    {
        $sql = $painting -> findByArtist($_GET['search']);
    }
    else
    {
        $results = $painting -> getAll(null);
    }
    
    $results = $painting -> getAll($sql);
    $rows = [];
    foreach ($results as $row)
    {
        $rows[] = $row;
    }
    
    header('Content-Type: application/json');
    var_dump(json_encode($rows, JSON_PRETTY_PRINT));
     searchPaintings();
?>