<?php
include_once 'vendor/simple_html_dom.php';

// create curl resource
$ch = curl_init();

echo 'Start on seconds: ' . date('s') . PHP_EOL;

// set url
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/14");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=t4p4a7jcifmb0qp90k5mrqr534");

// $output contains the output string
$output = curl_exec($ch);

// for debug
// file_put_contents('challenge13.html', $output);

$dom = str_get_html($output);

$toDecode = '';

$e = $dom->find('div[class=message]', 0)->plaintext;

$toDecode = $e;

// cleanup
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN MESSAGE -----/',
  '/----- END MESSAGE -----/',
];

$toDecode = preg_replace($patterns, '', $toDecode);
$toDecode = trim($toDecode);


$binarySplitted = str_split($toDecode, 8);
$hex = '';

foreach ($binarySplitted as $r) 
{
  $hex .= chr(base_convert($r , 2, 10)); 
  
  // debug
  
  //echo $r . ' - ' . chr(base_convert($r , 2, 16)) . PHP_EOL;
}

//die();

$result = hash('sha512', $hex);

//print_r($binarySplitted);

//echo $result . PHP_EOL;

// chiamata per il ricevere il flag
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/14/" . $result);

echo 'Ends on seconds: ' . date('s') . PHP_EOL;
// $output contains the output string
$output = curl_exec($ch);

// for debug
file_put_contents('challenge14.html', $output);


// close curl resource to free up system resources
curl_close($ch);
