<?php
include_once 'vendor/simple_html_dom.php';

// create curl resource
$ch = curl_init();

echo 'Start on seconds: ' . date('s') . PHP_EOL;

// set url
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/57");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=6sgl5gdbdvvtl97lac020erli7");

// $output contains the output string
$output = curl_exec($ch);

// for debug
// file_put_contents('challenge13.html', $output);

$dom = str_get_html($output);

$toDecode = '';

$target = $dom->find('div[class=message]', 0)->plaintext;
$salt = $dom->find('div[class=message]', 1)->plaintext;

// cleanup
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN HASH -----/',
  '/----- END HASH -----/',
  '/----- BEGIN SALT -----/',
  '/----- END SALT -----/',
];

$target = preg_replace($patterns, '', $target);
$target = trim($target);

$salt = preg_replace($patterns, '', $salt);
$salt = trim($salt);

/*
*   reverse hash sha1
*/

for($i=0; $i<=10000; $i++)
{
  if ( sha1($i.$salt) == $target )
  {
    $result = $i; 
  }

}

/*
*  chiamata per il ricevere il flag
*/

curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/57/" . $result);

echo 'Ends on seconds: ' . date('s') . PHP_EOL;

// $output contains the output string
$output = curl_exec($ch);

// for debug
file_put_contents('challenge57.html', $output);


// close curl resource to free up system resources
curl_close($ch);
