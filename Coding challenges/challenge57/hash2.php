<?php

$target = '82af88f1d7f53d088ca8327e46c8531c9f974078';

for($i=0; $i<=1000000000; $i++)
{
  if (sha1($i) == $target )
  {
    $result = $i;
  }

}

echo (isset($result)) ? $result : 'Not found';

echo PHP_EOL;
