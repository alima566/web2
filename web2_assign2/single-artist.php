<?php 

require 'includes/functions.inc.php'; 
require 'includes/single-artist-functions.inc.php';

?>

<!DOCTYPE html>
<html lang=en>
<head>
    
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
      <script>
  $(function() {
      
        $('.ui.menu .ui.dropdown').dropdown({
            on: 'hover'
        });

        $('.ui.menu a.item')
            .on('click', function() {
                $(this).addClass('active')
                       .siblings()
                       .removeClass('active');
            });

        $('.menu .item').tab();      
});
      
  </script>
    
</head>
<body >
    
<header>
  
  <?php include 'includes/header.inc.php'; ?>
    
</header> 
    
<main>
    <?php getArtistInformation(); ?>
</main>

</body>

</html>