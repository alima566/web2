<?php
require 'includes/functions.inc.php';
include 'includes/browse-paintings-functions.inc.php';

    $db = connectToDB();
    $painting = new PaintingDB ($db);
    //$service = new ServicePaintingDB ();
    
    if (isset($_GET['search']) && !empty($_GET['search']))
    {
        $searchFor = $_GET['search'] . '%';
        $sql = $painting -> getSearchResults($searchFor);
    }
    else if(isset($_GET['searchField']) && !empty($_GET['searchField']))
    {
        $searchFor = $_GET['searchField'] . '%';
        $sql = $painting -> getSearchBarResults($searchFor);
    }
    else if(isset($_GET['artist']) || isset($_GET['museum']) || isset($_GET['shape']))
    {
        $sql = $painting -> findByArtist($_GET['artist']);
        
        if ($_GET['museum'] != '0')
        {
            $sql = $painting -> findByGallery($_GET['museum']);    
        }
        else if ($_GET['shape'] != '0')
        {
                $sql = $painting -> findByShape($_GET['shape']);
        }
    }
    else
    {
        $results = $painting -> getAll(null);
    }
    
    $results = $painting -> getAll($sql);
    $rows1 = [];
    $rows2 = [];
    foreach ($results as $row)
    {
        $rows1[] = $row;
    }
    // foreach ($_SESSION['cart'] as $cart)
    // {
    //     $rows2[] = $cart;
    // }
    
    header('Content-Type: application/json');
    // if (empty($_SESSION['cart']) || !empty($_SESSION['cart']))
    // {
    echo json_encode($rows1);
    // }
    // else
    // {
    //     echo json_encode($_SESSION['cart']);
    // }
    //echo json_encode(array($rows1, $rows2));
    //searchPaintings();
?>