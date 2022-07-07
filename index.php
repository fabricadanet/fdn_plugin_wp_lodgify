<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();
$base_url = 'https://api.lodgify.com/v2/';
$api_key = 'i1waAKjJLTxPvbkIECMz7N37qpIzgBx8NGBmOGiYZlMHrlh93SuKvVEkxNc2qhpB';

$response = $client->request('GET', $base_url.'properties?includeCount=true&includeInOut=true&page=1&size=50', [
  'headers' => [
    'Accept' => 'application/json',
    'X-ApiKey' => $api_key,
  ],
]);
//$response->getBody();

$out=json_decode($response->getBody(), true);

$propertys = ['Ocean Retreat'=>257047,'Magnolia Ocean Retreat'=>309428, 'Edgewater Ocean Retreat - few steps away from the ocean'=>392675, 'Sunset Ocean Retreat, Dunedin/Clearwater'=>392676,'Marine Ocean Retreat - a few steps from the ocean'=>392677];
 
function getPropertyId($propertys, $propertyName) {
 	foreach ($propertys as $key => $value) {
 		if ($key == $propertyName) {
 			return $value.'--'.$key.'<br>';
 		}
 	}
 }

foreach ($out['items'] as $key => $value) {
    echo '#'.$value['id'].'<br>';
    echo 'Name: '.$value['name'].'<br>';
    echo 'City: '.$value['city'].'<br>';
    echo 'ZIP: '.$value['zip'].'<br>';
    echo 'Country: '.$value['country'].'<br>';
    echo 'Latitude: '.$value['latitude'].'<br>';
    echo 'Longitude: '.$value['longitude'].'<br>';
    echo "<img src=".$value['image_url']." alt=".$value['name']." width=\"300\" height=\"300\"><br>";
    echo '<a href=https://'.ltrim($value['image_url'], '/').'>Image</a><br>';
    echo 'Description: '.$value['description'].'<br>';
    echo 'Minimun Price: '.$value['min_price'].'<br>';
    echo 'Maximun Price: '.$value['max_price'].'<br>';
    echo 'Original Minimun Price: '.$value['original_min_price'].'<br>';
    echo 'Original Maximun Price: '.$value['original_max_price'].'<br>';
    echo 'Currency Code:'.$value['currency_code'].'<br>';
    echo 'Active: '.$value['is_active'].'<br>';
    echo '<hr>';
}
// var_dump($out['items'][0]);