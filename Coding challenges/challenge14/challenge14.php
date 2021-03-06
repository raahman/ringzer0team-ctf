<?php
include_once 'vendor/simple_html_dom.php';

/*
* Paste session id value es: PHPSESSID=t4p4a7jcifmb0qp90k5mrqr534
* so only : t4p4a7jcifmb0qp90k5mrqr534*
*/
$sessionId = '8fd2co0jgtpvvgtn19jbtuaeh7';
$toHash = '';
$ascii = '';

// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/14");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=" . $sessionId);

// $output contains DOM
$output = curl_exec($ch);

// Simple_html_dom function to manipulate HTML
$dom = str_get_html($output);

$toHash = $dom->find('div[class=message]', 0)->plaintext;

// Cleanup: tabs, new line and message wrapper

$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN MESSAGE -----/',
  '/----- END MESSAGE -----/',
];

$toHash = preg_replace($patterns, '', $toHash);
$toHash = trim($toHash);

/*
* Whole text split in row of 8 digits ( 8bit )
*/
$binarySplitted = str_split($toHash, 8);

/*
* Foreach row(string of 8 digits) will convert from base 2 to base 10.
* CHR will return the ascii character from ascii code(base10)
*/
foreach ($binarySplitted as $r) 
{
  $ascii .= chr(base_convert($r , 2, 10));
}

// Hash the text
$result = hash('sha512', $ascii);

// Send hash
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/14/" . $result);

// Store the result page to grap the FLAG
$output = curl_exec($ch);
$dom = str_get_html($output);

// echo FLAG
echo $dom->find('div[class=alert alert-info]', 0)->plaintext . PHP_EOL;

// for debug purpose
file_put_contents('challenge14.html', $output);

// close curl resource to free up system resources
curl_close($ch);
