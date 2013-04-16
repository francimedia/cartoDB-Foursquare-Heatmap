<?php if(isset($cache_filename)): ?>
<p class="lead">
  <br />
  Your heatmap file is ready! 
  Paste this link at CartoDB:
   <?php echo Router::get('download', array('name' => $cache_filename)); ?> 

  <br /><br />
</p>
<a class="btn btn-large btn-primary" href="<?php echo Router::get('download', array('name' => $cache_filename)); ?> ">OR: Download your Check-in GeoJson File</a>
<?php else: ?>
<p class="lead"><br />Create your personal checkin heatmap<br /> using CartoDB & Foursquare.</p>
<a class="btn btn-large btn-primary" href="<?php echo $login_url; ?>">
  Login with Foursquare
</a>
<?php endif; ?>