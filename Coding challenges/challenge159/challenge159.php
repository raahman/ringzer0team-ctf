<?php
include_once 'vendor/simple_html_dom.php';

/*
* paste session id value es: PHPSESSID=t4p4a7jcifmb0qp90k5mrqr534
* so only : t4p4a7jcifmb0qp90k5mrqr534*
*/
$sessionId = '06b1sjb1k926poqghrlljtbre5';
$toHash = '';

// create curl resource
$ch = curl_init();

// Set url & session cookie
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/159");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=" . $sessionId);

// $output contains DOM
$output = curl_exec($ch);

// Simple_html_dom function to manipulate HTML
$dom = str_get_html($output);
$toHash = $dom->find('div[class=message]', 0)->plaintext;

/*
*  Cleanup: tabs, new line and message wrapper
*/
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN HASH -----/',
  '/----- END HASH -----/',
];

$toHash = preg_replace($patterns, '', $toHash);
$toHash = trim($toHash); 

// Hash the message
$tmp = 'd94b40537b362801da53091372967c34ad9d9161';
echo $toHash; 

die();

// Send hash
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/159/" . $result);

// Store the result page to grap the FLAG
$output = curl_exec($ch);
$dom = str_get_html($output);

//echo FLAG
echo $dom->find('div[class=alert alert-info]', 0)->plaintext . PHP_EOL;

// for debug purpose
file_put_contents('challenge159.html', $output);

// close curl resource to free up system resources
curl_close($ch);
