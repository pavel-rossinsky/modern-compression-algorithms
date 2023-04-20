<?php

use Cab\Alg\Zstd;
use Cab\Alg\Zip;
use Cab\Alg\Lz4;

require __DIR__ . '/../vendor/autoload.php';

//echo ZSTD_COMPRESS_LEVEL_DEFAULT;
//die;

echo "ZSTD" . PHP_EOL;
$zstd = new Zstd();

$zstd->benchmark();

echo "ZIP" . PHP_EOL;
$zip = new Zip();

$zip->benchmark();

echo "LZ4" . PHP_EOL;
$lz4 = new Lz4();

$lz4->benchmark();