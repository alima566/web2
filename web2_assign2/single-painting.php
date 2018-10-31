<?php 

require 'includes/functions.inc.php'; 
require 'includes/single-painting-functions.inc.php';

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
      
        // initialize semanticUI components

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
      
        $('.event.example .image').dimmer({
            on: 'hover'
        });
      
      
        $('#artwork').on('click', function () {
            $('.ui.fullscreen.modal').modal('show');             
        });     
      
});
      
  </script>
    
</head>
<body >
    
<header>
  
  <?php include 'includes/header.inc.php'; ?>
    
</header> 
    
<main >
    <!-- Main section about painting -->
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">
          
          <?php outputPainting(); ?>
        
        <div class="seven wide column">
              
          <?php outputPaintingInfo(); ?>
              
                  
                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                    <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                    <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                    <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>    
                </div>
                
                <div class="ui bottom attached active tab segment" data-tab="details">
                  <table class="ui definition very basic collapsing celled table">
                    <tbody>
                    
                      <?php outputDetailsTab(); ?>
     
                    </tbody>
                  </table>
                </div>
                
                <div class="ui bottom attached tab segment" data-tab="museum">
                  <table class="ui definition very basic collapsing celled table">
                    <tbody>
                      
                      <?php outputMuseumTab(); ?>
          
                    </tbody>
                  </table>    
                </div>
                
                <div class="ui bottom attached tab segment" data-tab="genres">
                  
                  <?php outputGenresTab (); ?>

                </div>  
                
                <div class="ui bottom attached tab segment" data-tab="subjects">
                  
                  <?php outputSubjectsTab(); ?>
                  
                </div>  
                
                <!-- Cart and Price -->
                 <div class="ui segment">
                <form method="GET" action="add-to-cart.php?id=<?php echo $_GET['id']; ?>">
               
                    <div class="ui form">
                        <?php getCost(); ?>
                        <div class="four fields">
                          
                            <div class="three wide field">
                                <label>Quantity</label>
                                <input type="number" name="qty[]" min="0">
                            </div>     
                            
                            <div class="four wide field">
                                <label>Frame</label>
                                <select id="frame" name="frame[]" class="ui search dropdown">
                                <?php retrieveFrameOptions(); ?>
                                </select>
                            </div>  
                            
                            <div class="four wide field">
                                <label>Glass</label>
                                <select id="glass" name="glass[]" class="ui search dropdown">
                                  <?php retrieveGlassOptions(); ?>
                                </select>
                            </div>  
                            
                            <div class="four wide field">
                                <label>Matt</label>
                                <select id="matt"  name="matt[]" class="ui search dropdown">
                                  <?php retrieveMattOptions(); ?>
                                </select>
                            </div> 
                             <input type="hidden" name="id[]" value="<?php echo $_GET['id']; ?>" >
                        </div>                     
                    </div>

                    <div class="ui divider"></div>
                    <?php cartButton(); ?>
                    <?php favButton('pid', 'favPaintings'); ?>
                
                </form>
                
                      
                  </div> 
            </div>
            </div>
        
    </section>
    
    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">
        
            <div class="ui top attached tabular menu ">
              <a class="active item" data-tab="first">Description</a>
              <a class="item" data-tab="second">On the Web</a>
              <a class="item" data-tab="third">Reviews</a>
            </div>
            
            <div class="ui bottom attached active tab segment" data-tab="first">
              <?php outputDescriptionTab(); ?>
            </div> <!-- END Description Tab --> 
            
            <div class="ui bottom attached tab segment" data-tab="second">
              <table class="ui definition very basic collapsing celled table">
                <tbody>
                  <?php outputOnTheWebTab(); ?>
                </tbody>
              </table>
            </div> <!-- END On the Web Tab -->
            
            <div class="ui bottom attached tab segment" data-tab="third">
              <div class="ui feed">
                <?php outputReviewsTab(); ?>
              </div>                
            </div> <!-- END Reviews Tab -->          
        
        </div>        
    </section> <!-- END Description, On the Web, Reviews Tabs -->
    
    <!-- Related Images ... will implement this in assignment 2 -->    
    <section class="ui container">
    <h3 class="ui dividing header">Related Works</h3>        
	</section>  
	
</main>    
  
</body>
</html>