<?php 

require 'includes/functions.inc.php'; 
require 'includes/browse-subjects-functions.inc.php';

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
    
</head>
<body >
    
<header>
  
  <?php include 'includes/header.inc.php'; ?>
    
</header> 
    
<main>
    <section class="ui container"> <br/>
    
        <h2 class="ui dividing header">Subjects</h2>
     
        <div class="ui six stackable cards">
            
            <?php outputSubjects(); ?>
            
        </div>

    </section>
</main>

</body>

</html>