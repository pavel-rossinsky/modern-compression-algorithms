<?php

namespace Cab\Alg;

class Lz4 implements MeasurableInterface
{
    public function benchmark()
    {
//        $sample = file_get_contents('samples/sample_465kb.txt');
//        $sample = file_get_contents('samples/sample_2401kb.txt');
        
        foreach (glob("samples/*.txt") as $file) {
            echo $file . PHP_EOL;
            $sample = file_get_contents($file);
            $sampleLengthKb = (int)(strlen($sample)/1024);

            $timeDeflateTotal = 0.00;
            $timeInflateTotal = 0.00;
            for ($level = 0; $level <= 12; $level++) {
                for ($i = 0; $i != 50; $i++) {
                    $timeDeflate = -microtime(true);
                    $compressed = lz4_compress($sample, $level);
                    $timeDeflate += microtime(true);

                    $timeDeflateTotal+=$timeDeflate;

                    $compressedLengthKb = strlen($compressed)/1024;

                    //            $averageTimeDeflate[$level] = $averageTimeDeflate[$level] ?? 0.00;
                    //            $averageTimeDeflate[$level] += $timeDeflate;

                    $timeInflate = -microtime(true);
                    $decompressedSample = lz4_uncompress($compressed);
                    $timeInflate += microtime(true);

                    $timeInflateTotal += $timeInflate;

                    $compressRatio = $sampleLengthKb/$compressedLengthKb;
                    $spaceSaving = 1 - $compressedLengthKb/$sampleLengthKb;
                }

                echo sprintf("__time_to_deflate_level_%d: %.2f ms Compression ratio: %.1f Space saving: %.1f%%\n",$level, ($timeDeflateTotal/$i) * 1000, $compressRatio, $spaceSaving*100);
                echo sprintf("__time_to_inflate_level_%d: %.2f ms\n", $level, ($timeInflateTotal / $i) * 1000);
            }
        }
    }
}