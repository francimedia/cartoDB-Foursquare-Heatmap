<?php

/**
 * Alias the Log namespace to global so we can overload the Log class
 */
Autoloader::add_core_namespace('Foursquare');

/**
 * Inform the autoloader where to find what...
 */

/**
 * v1.x style classes.
 */
Autoloader::add_classes(array(
	'Foursquare\\Client'                    => __DIR__.'/classes/client.php',
));


