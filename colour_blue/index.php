<?php include('includes/functions.php'); include('includes/mysqli_connect.php'); ?>
<!DOCTYPE HTML>
<html>

<head>
  <title>colour_green</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
    <link rel="stylesheet" type="text/css" href="style/global.css" title="style" />

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  <script src="js/slides.min.jquery.js"></script>
  <script>
    $(function(){
      $('#slides').slides({
        preload: true,
        preloadImage: 'img/loading.gif',
        play: 5000,
        pause: 2500,
        hoverPause: true
      });
    });
  </script>
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.html">iz<span class="logo_colour">CMS</span></a></h1>
          <h2>Simple. Contemporary. CMS.</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <?php
       
        // Xac dinh cat_id de to dam link
        if(isset($_GET['cid']) && filter_var($_GET['cid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $cid = $_GET['cid'];
            $pid = NULL;
        } elseif(isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $pid = $_GET['pid'];
            $cid = NULL;
        } else {
            $cid = NULL;
            $pid = NULL;
        }
        // Cau lenh truy xuat categories
        $q = "SELECT cat_name, cat_id FROM categories ORDER BY position ASC";
        $r = mysqli_query($dbc, $q);
            confirm_query($r, $q);
        
        // Lay categories tu csdl
        while($cats = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo "<li><a href='index.php?cid={$cats['cat_id']}'";
                if($cats['cat_id'] == $cid) echo "class='selected'"; 
            echo ">".$cats['cat_name']. "</a>";
            
            // Cau lenh truy xuat pages
            $q1 = "SELECT page_name, page_id FROM pages WHERE cat_id={$cats['cat_id']} ORDER BY position ASC";
            $r1 = mysqli_query($dbc, $q1);
                confirm_query($r, $q);
                echo "<ul class='pages'>";
            
            // Lay pages tu csdl
            while($pages = mysqli_fetch_array($r1, MYSQLI_ASSOC)) { 
                echo "<li><a href='index.php?pid={$pages['page_id']}'";
                    if($pages['page_id'] == $pid) echo "class='selected'";
                echo ">".$pages['page_name']."</a></li>";
                
            } // End WHILE pages
                echo "</ul>";
            echo "</li>";
        } // End WHILE cats
       ?>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
        <!-- insert your sidebar items here -->
        <?php include('includes/posts.php'); ?>
        <ul>
          <li><a href="#">link 1</a></li>
          <li><a href="#">link 2</a></li>
          <li><a href="#">link 3</a></li>
          <li><a href="#">link 4</a></li>
        </ul>
        <h3>Search</h3>
        <form method="post" action="#" id="search_form">
          <p>
            <input class="search" type="text" name="search_field" value="Enter keywords....." />
            <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="style/search.png" alt="Search" title="Search" />
          </p>
        </form>
      </div>
      <div id="content">
          <div id="container">
            <div id="example">
              <img src="img/new-ribbon.png" width="112" height="112" alt="New Ribbon" id="ribbon">
              <div id="slides">
                <div class="slides_container">
                  <a href="http://www.flickr.com/photos/jliba/4665625073/" title="145.365 - Happy Bokeh Thursday! | Flickr - Photo Sharing!" target="_blank"><img src="http://slidesjs.com/examples/standard/img/slide-1.jpg" width="570" height="270" alt="Slide 1"></a>
                  <a href="http://www.flickr.com/photos/stephangeyer/3020487807/" title="Taxi | Flickr - Photo Sharing!" target="_blank"><img src="http://slidesjs.com/examples/standard/img/slide-2.jpg" width="570" height="270" alt="Slide 2"></a>
                  <a href="http://www.flickr.com/photos/childofwar/2984345060/" title="Happy Bokeh raining Day | Flickr - Photo Sharing!" target="_blank"><img src="http://slidesjs.com/examples/standard/img/slide-3.jpg" width="570" height="270" alt="Slide 3"></a>
                  <a href="http://www.flickr.com/photos/b-tal/117037943/" title="We Eat Light | Flickr - Photo Sharing!" target="_blank"><img src="http://slidesjs.com/examples/standard/img/slide-4.jpg" width="570" height="270" alt="Slide 4"></a>
                  <a href="http://www.flickr.com/photos/bu7amd/3447416780/" title="“I must go down to the sea again, to the lonely sea and the sky; and all I ask is a tall ship and a star to steer her by.” | Flickr - Photo Sharing!" target="_blank"><img src="http://slidesjs.com/examples/standard/img/slide-5.jpg" width="570" height="270" alt="Slide 5"></a>                </div>
                <a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
                <a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
              </div>
              <img src="img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
            </div>
          </div>
        <h2>izCMS registered users</h2>
        <p>izCMS currently have these users online:</p>
        <?php $users = fetch_users('last_name');
          foreach ($users as $user) {
            echo "<li>{$user['first_name']} {$user['last_name']}</li>";
            } // End foreach  

         ?>
        <ul>
          
        </ul>
      </div> <!-- content-->
    </div>
    <div id="content_footer"></div>
    <div id="footer">
      Copyright &copy; colour_green | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.html5webtemplates.co.uk">design from HTML5webtemplates.co.uk</a>
    </div>
  </div>
</body>
</html>
