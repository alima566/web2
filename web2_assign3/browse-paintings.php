<?php 

require 'includes/functions.inc.php'; 
require 'includes/browse-paintings-functions.inc.php';

?>

<!DOCTYPE html>
<html lang=en>
<head>
    
<meta charset=utf-8>
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>    
       
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
    <!--<script type="text/javascript" language="javascript" src="js/filterList.js"></script> -->
    <script type="text/javascript" language="javascript" src="js/search.js"></script>
    <!--<script type="text/javascript" language="javascript" src="js/assign3.js"></script>-->
    <script src="css/semantic.js"></script> 
   
</head>

<body>
    
<header>
  <?php include 'includes/header.inc.php'; ?>
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
              <select id="artist" class="ui fluid search dropdown" name="artist">
              <option class="item" value="0">Select Artist</option>
              <?php artistDropdownList(); ?>
              </select>
            </div>
    
            <div class="field">
              <label>Museum</label>
              <select id="museum" class="ui fluid search dropdown" name="museum">
              <option class="item" value="0">Select Museum</option>
              <?php museumDropdownList(); ?>
              </select>
            </div>
    
            <div class="field">
              <label>Shape</label>
              <select id="shape" class="ui fluid search dropdown" name="shape">
              <option class="item" value="0">Select Shape</option>
              <?php shapeDropdownList(); ?>
              </select>
            </div>
            
            <!--<button class="ui orange button" type="submit"><i class="filter icon"></i>Filter</button>-->
          
          </form>
          
      </div>
    
      <div class="twelve wide column">
      <h1 class="ui header" id="header">Paintings</h1>
      <div id="loader" class="ui active centered inline loader"></div>
        <div class="ui items" id="items">
           
        </div>

      </div>

    </div>
  </div>

</main>

  <?php include 'includes/footer.inc.php'; ?>

</body>

</html>