<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.5
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
{

	private $FoursquareClient;

	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		$data = array();

		if ( $code = Input::get('code') ) {
			$data['cache_filename'] = $this->createGeoJsonData($code);
		}		

		$data['login_url'] = 'https://foursquare.com/oauth2/authenticate?client_id=3X13LKHOUSQBZEVOIKKCB1SZXOMM3CGDIVB2AOG5CSRGJSEZ&response_type=code&redirect_uri='.urlencode(Uri::base(false));

		return Response::forge(View::forge('welcome/index', $data));
	}

	public function action_download($cache_filename)
	{

		if(!$cache_filename) {
			return $this->action_404();
		}

		// add json extension
		$cache_filename .= '.json';
		
	    // load data from cache if possible
		try
		{
		    $data = Cache::get($cache_filename);
		}
		catch (\CacheNotFoundException $e)
		{
		    return $this->action_404();	        
		}

		// cache found but empty!?
		if(!$data) {
			return $this->action_404();
		}

		$response = new Response();

		// We'll be outputting a json string
		$response->set_header('Content-Type', 'application/json');

		// It will be called downloaded.pdf
		$response->set_header('Content-Disposition', 'attachment; filename="checkins.json"');

		// Set no cache
		$response->set_header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
		$response->set_header('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
		$response->set_header('Pragma', 'no-cache');

		$response->body($data);

		return $response;
	}

	private function createGeoJsonData($code) {

		Package::load('Foursquare'); 	
		$this->FoursquareClient = new \Foursquare\Client;

		// get locations surrounding lat/lng geo point.
		$response = $this->FoursquareClient->get('getAccessToken', $code, 'authorization_code', 'http://'.$_SERVER['HTTP_HOST'].'/');
		if(!isset($response->access_token)) {
			return false;
		}

		// create a cache filename based on user access token
	    $cache_filename = substr(md5($response->access_token),0,31).'.json';

	    // load data from cache if possible
		try
		{
			$data = Cache::get($cache_filename);
		    return $cache_filename;
		}
		catch (\CacheNotFoundException $e)
		{
		    /*
		        Catching the CacheNotFoundException exception will catch
		        both CacheNotFoundException and CacheExpiredException.
		        Use this when catching the exception.
		    */
			return $this->loadCheckins($cache_filename, $response->access_token);		        
		}

	}

	private function loadCheckins($cache_filename, $access_token) {

		// checkin cache file expires after x minutes
		$expire = 60;
		
		// 10 times = 2500 checkins, OK?
		$cycles = 10;
		
		$items_per_request = 250;

        $data = array();
        $data['type'] = 'FeatureCollection';
        $data['features'] = array();

		// limit per request: 250 checkins, so do it several times.
		for($i=0;$i<$cycles;$i++) {
		
			$limit = ($i+1) * $items_per_request;
			$offset = $i * $items_per_request;

			// get user checkins 
			$checkins = $this->FoursquareClient->get('getUserCheckins', $access_token, $limit, $offset);
			//  print_r($checkins);
			//  exit;		


	        foreach ($checkins->response->checkins->items as $key => $row) {
	            if(!isset($row->venue)) {
	            	continue;
	            }
	            $data['features'][] = array(
	                'type' => 'Feature',
	                'properties' => array(
	                	'name' => $row->venue->name,
	                	'city' => (isset($row->venue->location->city) ? $row->venue->location->city : ''),
	                	'count' => 1
	                ),
	                'geometry' => array(
	                    'type' => 'Point',
	                    'coordinates' => array((float)($row->venue->location->lng),(float)($row->venue->location->lat))
	                )
	            );
	        } 
	    }  


	    Cache::set($cache_filename, json_encode($data), ($expire * 60));

        return $cache_filename;

	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(ViewModel::forge('welcome/404'), 404);
	}
}
