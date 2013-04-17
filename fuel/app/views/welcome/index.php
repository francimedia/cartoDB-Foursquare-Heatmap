<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CartoDB Foursquare Heatmap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="/assets/css/bootstrap-responsive.css" />
		<link type="text/css" rel="stylesheet" href="/assets/css/main.css" />

	<meta property="og:title" content="CartoDB Foursquare Heatmap" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://cartodbfoursquareheatmap.herokuapp.com/" />
	<meta property="og:image" content="https://cartodbfoursquareheatmap.herokuapp.com/assets/img/step-2.jpg" />
	<meta property="og:site_name" content="CartoDB Foursquare Heatmap" />

</head>
<body>

    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">

        <div class="navbar navbar-inverse">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/">CartoDB Foursquare Heatmap</a>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li>
                	<div style="display: inline-block; margin-right: 20px; margin-top: 15px;" class="fb-like" data-href="https://cartodbfoursquareheatmap.herokuapp.com/" data-send="true" data-layout="button_count" data-width="250" data-show-faces="false" data-colorscheme="dark"></div>
                </li>
                <li class="active"><a href="#">Sources:</a></li>
                <li><a href="http://cartodb.com/" target="_blank">CartoDB.com</a></li> 
                <li><a href="http://foursquare.com/" target="_blank">Foursquare.com</a></li> 
                <li><a href="https://github.com/francimedia/cartoDB-Foursquare-Heatmap" target="_blank">Fork on Github</a></li>
                
              </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->



    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <img src="/assets/img/slide-01.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Create your personal Foursquare Heatmap</h1>
              <?php include(dirname(__FILE__).'/_item.php'); ?>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="/assets/img/slide-02.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Style your map</h1>
              <?php include(dirname(__FILE__).'/_item.php'); ?>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="../assets/img/slide-03.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Share your map <br />- if you are nuts :-)</h1>
              <?php include(dirname(__FILE__).'/_item.php'); ?>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="span4">
          <img class="img-circle" src="/assets/img/step-1.jpg">
          <h2>1. Login with Foursquare</h2>
          <p>
          		Connect your Foursquare Account to our app, it will grab and convert your check-ins. Your check-in data is NOT stored in a database and just accessible for you.<br /><br />
          </p>
          <?php if(!isset($cache_filename)): ?>
          <p><a class="btn" href="<?php echo $login_url; ?>">Login with Foursquare &raquo;</a></p>
          <?php endif; ?>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img-circle" src="/assets/img/step-2.jpg">
          <h2>2. Download GeoJSON</h2>
          <p>
          		After connecting your account we will offer you the possibilty to download your personal GeoJSON file - <strong>ready for CartoDB!</strong>
          		Your download link will expire after 60mins.<br /><br />          		
          </p>
          <?php if(isset($cache_filename)): ?>
          <p><a class="btn" href="<?php echo Router::get('download', array('name' => $cache_filename)); ?>">Download your Check-in GeoJson File &raquo;</a></p>
      	  <?php endif; ?>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img-circle" src="/assets/img/step-3.jpg">
          <h2>3. Sign up at CartoDB</h2>
          <p>
          	Create an account on CartoDB - it's free (for up to 5 tables...)!
          	Next create a new table and upload your GeoJSON file.
          	<br /><br /><br />
          </p>
          <p><a class="btn" href="http://cartodb.com/">Sign in or Sign up &raquo;</a></p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->

      <br /><br /><br /><br />
      <div class="row">
        <div class="span4">
          <img class="img-circle" src="/assets/img/step-4.jpg">
          <h2>4. Skin your map</h2>
          <p>
          		CartoDB will offer you to skin your map. Both the map layer and your check-in markers.
          </p>
          <p><a class="btn" href="http://cartodb.com/tour">Learn more &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img-circle" src="/assets/img/step-5.jpg">
          <h2>5. <u>Don't</u> share! :-)</h2>
          <p>
          		For privacy reasons you should NOT share your map!<br />
          		After playing with it, better delete it - or get a paid CartoDB account (which offers private tables).
          </p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->

      <!-- FOOTER -->
      <br />
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>
        	Made with love by <a href="http://about.me/stephanalber" target="_blank">Stephan Alber</a> |
        	<em> This project is NOT affiliated with CartoDB / Foursquare</em>
        </p>
      </footer>

    </div><!-- /.container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
    <script src="/assets/js/holder.js"></script>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=506169639432441";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>    

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-36542114-2', 'herokuapp.com');
	  ga('send', 'pageview');

	</script>	
  </body>
</html>