<?php include 'includes/functions.inc.php'; ?>

<!DOCTYPE html>
<html lang=en>
<head>
    
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/search.js"></script>
    <script src="css/semantic.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
</head>
<body >
    
<header>
  
  <?php include 'includes/header.inc.php'; ?>
    
</header>   
  
<main class="ui container"><br>
  <div class="ui tertiary very padded segment">
    <div class="ui four column grid"><br>
      <div class="ui items">
        <div class="item">
          <div class="ui medium image">
            <img class="ui tiny image" src="images/slide.gif">
          </div>
          
          <div class="content">
            <h2 class="ui header">Aaron Li-Mai & Pranay Patel</h2>
              <div class="meta">
                <a href="http://www.mtroyal.ca/bcis" target="_blank"><span class="cinema">Bachelor of Computer Information Systems</span></a>
              </div>
              
              <div class="ui list">
                <div class="item">
                  <i class="marker icon"></i>
                    <div class="content">
                      Calgary, AB
                    </div>
                </div>
                
                <div class="item">
                  <i class="calendar outline icon"></i>
                    <div class="content">
                      <?php echo date('M d, Y', strtotime('-7 hours')); ?>
                    </div>
                  </div>
                  
                  <div class="item">
                  <i class="wait icon"></i>
                    <div class="content">
                      <?php echo date(" H:i:s", strtotime('-7 hours'));?>

                    </div>
                  </div>
                
                <div class="item">
                  <i class="book icon"></i>
                    <div class="content">
                      COMP 3512: Web II 
                    </div>
                </div>
                
                <div class="item">
                  <i class="mail icon"></i>
                    <div class="content">
                      <a href="mailto:alima566@mtroyal.ca">alima566@mtroyal.ca</a> ||
                      <a href="mailto:ppate590@mtroyal.ca">ppate590@mtroyal.ca</a>
                    </div>
                </div>

              </div>
              
              <div class="description">
                <p>Just a hypothetical site created as a term project for COMP 3512: Web II class taught by Randy Connolly.</p>
              </div><br>
              
              <div class="ui very padded container">
                <a href="https://ca.linkedin.com/in/aaronlimai" target="_blank">
                  <button class="ui linkedin button">
                    <i class="linkedin icon"></i>
                      Aaron's LinkedIn
                  </button>
                </a>
                
                <a href="https://www.linkedin.com/in/pranay-patel" target="_blank">
                  <button class="ui linkedin button">
                    <i class="linkedin icon"></i>
                      Pranay's LinkedIn
                  </button>
                </a>
                
              </div>
          </div>
        </div>
      </div>
    </div><br>
  </div>
  <div class="ui segment">
    <h3>Resources Used</h3>
      <table class="ui padded striped three column blue table">
        <thead>
          <tr>
            <th>Resources</th>
            <th>Source</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>SemanticCSS</td>
            <td><a href="http://semantic-ui.com/" target="_blank">http://semantic-ui.com</a></td>
            <td>Semantic UI development framework to replace traditional CSS</td>
          </tr>
          
          <tr>
            <td>Gif Maker</td>
            <td><a href="http://makeagif.com/" target="_blank">http://makeagif.com</a></td>
            <td>Used to mash-up images on "aboutus.php" page</td>
          </tr>
          
          <tr>
            <td>Artist Images</td>
            <td>Various</td>
            <td>Downloaded images of some artists which were missing </td>
          </tr>
        </tbody>
      </table>
  </div>
  
  <div class="ui segment">
    <div class="ui grid">
      
      <div class="eight wide column">
        <h3 class="ui dividing header">
          <img src="images/Other/Aaron.png" class="ui circular image" alt="..." />
          What Aaron Li-Mai Did:
        </h3>
        
          <div class="ui list">
            <div class="item">
              <i class="theme icon"></i>
                <div class="content">
                  Browse/Single Genre pages
                </div>
            </div>
          </div>
          
          <div class="ui list">
            <div class="item">
              <i class="cube icon"></i>
                <div class="content">
                  Browse/Single Subject pages
                </div>
            </div>
          </div>
          
          <div class="ui list">
            <div class="item">
              <i class="users icon"></i>
                <div class="content">
                  Browse/Single Artist page
                </div>
            </div>
          </div>
          
          <div class="ui list">
            <div class="item">
              <i class="info circle icon"></i>
                <div class="content">
                  About Us page
                </div>
            </div>
          </div>
          
          <div class="ui list">
            <div class="item">
              <i class="shop icon"></i>
                <div class="content">
                  View/Add to Cart pages
                </div>
            </div>
          </div>
          
          <div class="ui list">
            <div class="item">
              <i class="heart icon"></i>
                <div class="content">
                  View/Add to Favorites pages
                </div>
            </div>
          </div>
          
          <div class="ui list">
            <div class="item">
              <i class="university icon"></i>
                <div class="content">
                  Browse/Single Gallery pages
                </div>
            </div>
          </div>
          
          <div class="ui list">
            <div class="item">
              <i class="search icon"></i>
                <div class="content">
                  Simple Search/Search Results
                </div>
            </div>
          </div>
          
      </div>
    
    <div class="eight wide column">
      
      <h3 class="ui dividing header">
        <img src="images/Other/pranay.jpg" class="ui circular image" alt="..." />
        What Pranay Patel Did:
      </h3>
      
      <div class="ui list">
        <div class="item">
          <i class="info circle icon"></i>
            <div class="content">
              About Us page
            </div>
        </div>
      </div>
      
      <div class="ui list">
        <div class="item">
          <i class="shop icon"></i>
            <div class="content">
              View/Add to Cart pages
            </div>
        </div>
      </div>
      
      <div class="ui list">
        <div class="item">
          <i class="heart icon"></i>
            <div class="content">
              View/Add to Favorites pages
            </div>
        </div>
      </div>
      
      <div class="ui list">
        <div class="item">
          <i class="university icon"></i>
            <div class="content">
              Single Gallery page
            </div>
        </div>
      </div>
      
      <div class="ui list">
        <div class="item">
          <i class="search icon"></i>
            <div class="content">
              Simple Search/Search Results
            </div>
        </div>
      </div>
      
      <div class="ui list">
            <div class="item">
              <i class="paint brush icon"></i>
                <div class="content">
                  Browse/Single Painting pages
                </div>
            </div>
          </div>
          
           <div class="ui list">
            <div class="item">
              <i class="users icon"></i>
                <div class="content">
                  Browse/Single Artist page
                </div>
            </div>
          </div>
      
    </div>
    
  </div>
  
</main>

  <?php include 'includes/footer.inc.php'; ?>
  
</body>
</html>