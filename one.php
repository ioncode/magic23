<?php
$a = magic(5);
echo $a(2).PHP_EOL; //7
echo $a(5).PHP_EOL; //12
echo $a(3).PHP_EOL; //15

function magic($num):callable
{
    $doMagic = new doMagic($num);
    return $doMagic->secondLevel();
}

