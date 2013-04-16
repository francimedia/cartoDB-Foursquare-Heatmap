<?php

$input = "New York NY 10010 Store #543 - (212) 255-2106
OPEN 8:00AM TO 10:00PM DAILY
BANANAS ORGANIC	0.29
BANANAS	0.19
BANANAS	0 19
SALAD HARVEST WITH CHICKEN	3 99
SUSHI OKAMI SPICY CALIFORNIA R 3.69 4-ORANGE EACH NAVELS	0.69
'vr";

class ReadReceipt {
	
	private $productNames = array(
		'banana',
		'apple',
		'orange',
		'tomato'
	);
	
	private $productAttributes = array(
		'organic',
	);

	public function run($input) {
		$data = $this->extractLines($input);
		$matches = array();
		$indexes = array();
		foreach ($data as $key => $line) {
			foreach ($this->productNames as $productName) {
				if(substr_count(strtolower($line), $productName)) {
					$matches[] = $line;
					$index = -1;
					if(preg_match("/^([1-9][0-9]*|0)(\.[0-9]{2})?$/", $line, $_matches, PREG_OFFSET_CAPTURE)) {
					// if(preg_match("/".$productName."/", strtolower($line), $_matches, PREG_OFFSET_CAPTURE)) {
					    $indexes[] = $_matches[0][1];
					}					
				}
			}
		} 

		print_r($indexes);
		print_r($matches);
		exit;
	}

	private function extractLines($input) {
		$data = explode("\n", $input);
		return $data;
	}


}


$ReadReceipt = new ReadReceipt();
$ReadReceipt->run($input);