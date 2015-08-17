<?php
include_once 'vendor/simple_html_dom.php';

// create curl resource
$ch = curl_init();

echo 'Start on seconds: ' . date('s') . PHP_EOL;

// set url
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/17");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=6sgl5gdbdvvtl97lac020erli7");

// $output contains the output string
$output = curl_exec($ch);

// for debug
// file_put_contents('challenge13.html', $output);

$dom = str_get_html($output);

$image = $dom->find('div[class=message]', 0)->find('img', 0)->src;

// cleanup
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- IMAGE -----/',
];

$image = preg_replace($patterns, '', $image);
$image = trim($image);

$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

file_put_contents('toocr.png', $data);

die();

/*
*  chiamata per il ricevere il flag
*/ 

curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/17/" . $result);

echo 'Ends on seconds: ' . date('s') . PHP_EOL;
// $output contains the output string
$output = curl_exec($ch);

// for debug
file_put_contents('challenge15.html', $output);


// close curl resource to free up system resources
curl_close($ch);
