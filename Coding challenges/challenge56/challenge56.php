<?php
include_once 'vendor/simple_html_dom.php';

// create curl resource
$ch = curl_init();

echo 'Start on seconds: ' . date('s') . PHP_EOL;

// set url
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/56");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=beogl972k3m6ad3kld8hcf7871");

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
  '/----- BEGIN HASH -----/',
  '/----- END HASH -----/',
];

echo $toDecode . PHP_EOL;

$toDecode = preg_replace($patterns, '', $toDecode);
$toDecode = trim($toDecode);

echo '|' . $toDecode . '|' .PHP_EOL;

/* 
*   REVERSE SHA1
*/

curl_setopt($ch, CURLOPT_URL, "https://hashtoolkit.com/reverse-hash/?hash=" . $toDecode);

// $output contains the output string
$output = curl_exec($ch);

// simpledomhtml
$dom = str_get_html($output);

$e = $dom->find('td[class=res-text]', 0)->find('span', 0);

$result = $e->innertext;

//echo 'Result: ' . $result . PHP_EOL;

/*
*  chiamata per il ricevere il flag
*/

curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/56/" . $result);

echo 'Ends on seconds: ' . date('s') . PHP_EOL;

// $output contains the output string
$output = curl_exec($ch);

// for debug
file_put_contents('challenge56.html', $output);


// close curl resource to free up system resources
curl_close($ch);
