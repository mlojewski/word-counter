<?php

namespace App\service;

class TextTransformer
{
    private $counter;
    public function __construct(WordStatCounter $counter)
    {
        $this->counter = $counter;
    }
    
    public function generateFromUrl (string $url): \Generator
    {
        $fileContent = fopen($url, 'r');

        while(!feof($fileContent)) {
            yield trim(fgets($fileContent));
        }
        fclose($fileContent);
    }
    
    public function textDivider(string $url)
    {
        $iterator = $this->generateFromUrl($url);
    
        $buffer = "";
        $resultArr = [];
        
        foreach ($iterator as $iteration) {

            preg_match("/\n{3}/", $buffer, $matches);
        
            if (count($matches)) {
                print ".";
                $buffer = "";
            } else {
                $buffer .= $iteration . PHP_EOL;
            }
            if ($iteration !== '') {
                $arr = $this->counter->countLetters($this->phraseDivider($iteration));
                foreach ($arr as $item) {
                    if ($item != 0) {
                        if (!array_key_exists($item, $resultArr)) {
                            $resultArr[$item] = 1;
                        } else {
                            $resultArr[$item]++;
                        }
                    }
                }
            }
        }
        ksort($resultArr);

        return $resultArr;
    }
    
    public function phraseDivider(string $phrase): array
    {
        $wordArray = explode(' ', $phrase);
        return $wordArray;
    }
}