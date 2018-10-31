<?php require 'functions.inc.php'; ?>

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

<body>
    
<header>
  
  <?php include 'header.inc.php'; ?>
    
</header> 
    
<main class="ui container">
  
  <br/>
  
  <div class="ui segment">
  
    <div class="ui grid">
    
      <div class="four wide column">
    
        <h3 class="ui dividing header">Filters</h3>
        
          <form class="ui form" action="browse-paintings.php">
            
            <div class="field">
              <label>Artist</label>
              <select class="ui fluid search dropdown" name="artist">
              <option class="item" value="0">Select Artist</option>
              <?php artistDropdownList(); ?>
              </select>
            </div>
    
            <div class="field">
              <label>Museum</label>
              <select class="ui fluid search dropdown" name="museum">
              <option class="item" value="0">Select Museum</option>
              <?php museumDropdownList(); ?>
              </select>
            </div>
    
            <div class="field">
              <label>Shape</label>
              <select class="ui fluid search dropdown" name="shape">
              <option class="item" value="0">Select Shape</option>
              <?php shapeDropdownList(); ?>
              </select>
            </div>
            
            <button class="ui orange button" type="submit"><i class="filter icon"></i>Filter</button>
          
          </form>
          
      </div>
    
      <div class="twelve wide column">
      
        <div class="ui items">
      
          <h1 class="ui header">Paintings</h1>

          <?php filterSearch(); ?>
          
        </div>

      </div>

    </div>
  </div>

</main>

</body>

</html>