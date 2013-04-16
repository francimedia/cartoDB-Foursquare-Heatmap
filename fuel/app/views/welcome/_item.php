<?php if(isset($cache_filename)): ?>
<p class="lead">
  Your heatmap file is ready!
</p>
<a class="btn btn-large btn-primary" href="/welcome/download/<?php echo $cache_filename; ?>">Download your Check-in GeoJson File</a>
<?php else: ?>
<p class="lead">Create your personal checkin heatmap using cartoDB & Foursquare.</p>
<a class="btn btn-large btn-primary" href="https://foursquare.com/oauth2/authenticate?client_id=3X13LKHOUSQBZEVOIKKCB1SZXOMM3CGDIVB2AOG5CSRGJSEZ&response_type=code&redirect_uri=<?php echo urlencode('http://'.$_SERVER['HTTP_HOST'].'/'); ?>">
  Login with Foursquare
</a>
<?php endif; ?>