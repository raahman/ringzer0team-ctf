<?php

function perm($arr, $n, $result = array())
{
    if($n <= 0) return false;
    $i = 0;

    $new_result = array();
    foreach($arr as $r) {
    if(count($result) > 0) {
        foreach($result as $res) {
                $new_element = array_merge($res, array($r));
                $new_result[] = $new_element;
            }
        } else {
            $new_result[] = array($r);
        }
    }

    if($n == 1) return $new_result;
    return perm($arr, $n - 1, $new_result);
}

$target = '82af88f1d7f53d088ca8327e46c8531c9f974078';

$array = [
'a', 'b',	'c', 'd',	'e', 'f',	'g', 'h',	'i', 'j', 'k', 'l',	'm', 'n',	'o', 'p', 'q', 'r',	's', 't', 'u', 'v', 'w', 'x',	'y', 'z', 
'1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 
'A', 'B',	'C', 'D',	'E', 'F',	'G', 'H',	'I', 'J', 'K', 'L',	'M', 'N',	'O', 'P', 'Q', 'R',	'S', 'T', 'U', 'V', 'W', 'X',	'Y', 'Z',
'!', '"', "'", '#', '$', '%', '&', '(', ')', '*', '+', ',', '-', '.', '/', ':', ';', '<', '=', '>', '?',
];

$permutations = perm($array, 4);
// print_r($permutations);

echo "End gen permutation." . PHP_EOL;

foreach( $permutations as $comb)
{
  if (sha1(implode($comb)) == $target )
  {
    $result = implode($comb);
  }

}

echo (isset($result)) ? $result : 'Not found';

echo PHP_EOL;
