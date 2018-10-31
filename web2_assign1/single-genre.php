<?php require 'functions.inc.php'; ?>

<!DOCTYPE html>
<html lang=en>
<head>
    
<meta charset=utf-8>.
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
</head>
<body >
    
<header>
  
  <?php include 'header.inc.php'; ?>
    
</header> 
    
<main>
    <div class="ui message">
        <div class="ui container">
        <div class="ui items">
        
            <?php getGenreInformation(); ?>
            
        </div>
        </div>
    </div>
    <section class="ui container">
        
        <h3 class="ui dividing header">Paintings</h3>
        
        <?php outputGenrePaintings(); ?>
        
    </section>
</main>

</body>

</html>