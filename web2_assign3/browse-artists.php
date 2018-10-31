<?php 

require 'includes/functions.inc.php'; 
require 'includes/browse-artists-functions.inc.php';

?>

<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/search.js"></script>
    <script src="css/semantic.js"></script>
    
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>    
    <script type="text/javascript" language="javascript" src="js/assign3.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
</head>
<body >
    
<header>
  
  <?php include 'includes/header.inc.php'; ?>
    
</header> 
    
<main>
    <section class="ui container"> <br/>
        <h2 class="ui dividing header">Artists</h2>
     
        <div class="ui six stackable cards">
            
            <?php outputArtists(); ?>
            
        </div>

    </section>
</main>

    <?php include 'includes/footer.inc.php'; ?>

</body>

</html>