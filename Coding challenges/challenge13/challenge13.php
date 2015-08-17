<?php
include_once 'vendor/simple_html_dom.php';

// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/13");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=	t4p4a7jcifmb0qp90k5mrqr534");

// $output contains the output string
$output = curl_exec($ch);

// for debug
// file_put_contents('challenge13.html', $output);

$dom = str_get_html($output);

$toDecode = '';

foreach ($dom->find('div[class=message]') as $e ) {
  $toDecode = $e->plaintext;
}

// cleanup
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN MESSAGE -----/',
  '/----- END MESSAGE -----/',
];

$toDecode = preg_replace($patterns, '', $toDecode);
$toDecode = trim($toDecode); 

$result = hash('sha512', $toDecode);

// chiamata per il ricevere il flag
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/13/" . $result);

// $output contains the output string
$output = curl_exec($ch);

// for debug
file_put_contents('challenge13.html', $output);

// close curl resource to free up system resources
curl_close($ch);
