<?php 

require 'includes/functions.inc.php'; 
require 'includes/single-gallery-functions.inc.php';

?>

<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/search.js"></script>
    <script src="css/semantic.js"></script>
    
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>    
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    <style>
       #map 
       {
        height: 335px;
        width: 100%;
       }
    </style>
    
</head>
<body >
    
<header>
  
  <?php include 'includes/header.inc.php'; ?>
    
</header> 
    
<main>
    <section class="ui container"> <br/>

        <?php getGalleryInformation(); ?>

    </section>
</main>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUqvRO_m3tVNhfJV4xUF_GUig5uvWgE4k&callback=initMap">
    </script>
 
</body>

</html>