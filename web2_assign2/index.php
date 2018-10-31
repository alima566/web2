<?php include 'includes/functions.inc.php'; ?>

<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
    
    
</head>
<body >
    
<header>
    
    <?php include 'includes/header.inc.php'; ?>
    
</header> 

<div class="hero-container">
    <div class="ui text container">
        <h1 class="ui huge header">Decorate your world</h1>
        <a href="browse-paintings.php" class="ui huge orange button" >Shop Now</a>
    </div>  
</div>  

<h2 class="ui horizontal divider"><i class="tag icon"></i> Deals</h2>   
    
<main class="ui three column container">
  
  <div class="ui stackable equal width grid">
    
      <div class="column">
        <div class="ui fluid card">
          <div class="image">
            <img src="images/art/works/medium/107050.jpg">
          </div>
            <div class="content">
              <h4 class="header">Experience the sensuous pleasures of the French Rococo</h4>
            </div>
            <a href="single-genre.php?id=83">
              <div class="ui bottom attached button">
                <i class="info circle icon"></i>
                See More
              </div> 
            </a>
        </div>
      </div>

      <div class="column">
        <div class="ui fluid card">
          <div class="image">
            <img src="images/art/works/medium/126010.jpg">
          </div>
            <div class="content">
              <h4 class="header">Appeciate the quiet beauty of the Dutch Golden Age</h4>
            </div>
            <a href="single-genre.php?id=87">
              <div class="ui bottom attached button">
                <i class="info circle icon"></i>
                See More
              </div>
            </a>
        </div>
      </div>

      <div class="column">
        <div class="ui fluid card">
          <div class="image">        
            <img src="images/art/works/medium/100030.jpg">
          </div>
            <div class="content">
              <h4 class="header">Discover the glorious color of the Renaissance</h4>
            </div>
            <a href="single-genre.php?id=78">
              <div class="ui bottom attached button">
                <i class="info circle icon"></i>
                See More
              </div>
            </a>
        </div>
      </div>
    
  </div>
  
</main>

</body>
</html>