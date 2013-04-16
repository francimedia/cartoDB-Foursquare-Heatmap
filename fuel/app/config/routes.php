<?php
return array(
	'home'  => '',  // The default route
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	 'download/(:name)' => array('welcome/download/$1', 'name' => 'download'),
	// 'download/(:any)?' => 'welcome/download',
);