<?php

namespace Cab\Alg;

class Zip implements MeasurableInterface
{
    public function benchmark()
    {
//        $sample = file_get_contents('samples/sample_465kb.txt');
        $file = 'samples/sample_2401kb.txt';
        echo $file . PHP_EOL;
        $sample = file_get_contents('samples/sample_2401kb.txt');

        $sampleLengthKb = (int)(strlen($sample)/1024);

        for ($level = 0; $level <= 9; $level++) {
            $timeDeflate = -microtime(true);
            $compressed = gzdeflate($sample, $level);
            $timeDeflate += microtime(true);

            $compressedLengthKb = strlen($compressed)/1024;

//            $averageTimeDeflate[$level] = $averageTimeDeflate[$level] ?? 0.00;
//            $averageTimeDeflate[$level] += $timeDeflate;

            $timeInflate = -microtime(true);
            $decompressedSample = gzinflate($compressed);
            $timeInflate += microtime(true);

            $compressRatio = $sampleLengthKb/$compressedLengthKb;
            $spaceSaving = 1 - $compressedLengthKb/$sampleLengthKb;

            echo sprintf("__time_to_deflate_level_%d: %.2f ms Compression ratio: %.1f Space saving: %.1f%%\n",$level, $timeDeflate * 1000, $compressRatio, $spaceSaving*100);
        }
    }
}