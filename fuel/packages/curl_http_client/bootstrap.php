<?php

// Add namespace, necessary if you want the autoloader to be able to find classes
Autoloader::add_namespace('curl_http_client', __DIR__.'/classes/');

// Add as core namespace
Autoloader::add_core_namespace('curl_http_client');

// Add as core namespace (classes are aliased to global, thus useable without namespace prefix)
// Set the second argument to true to prefix and be able to overwrite core classes
Autoloader::add_core_namespace('curl_http_client', true);

// And add the classes, this is useful for:
// - optimization: no path searching is necessary
// - it's required to be able to use as a core namespace
// - if you want to break the autoloader's path search rules
Autoloader::add_classes(array(
    'curl_http_client\\curl_http_client' => __DIR__.'/classes/curl_http_client.php' 
));