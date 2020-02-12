<?php

namespace App\service;

class DocumentStatCounter
{
    public function globalWordCounter(array $resultArr)
    {
        $outcome = 0;
        foreach ($resultArr as $key => $value) {
            $outcome += $value;
        }
        return $outcome;
    }
    
    public function countAverage(array $resultArr)
    {
        $wordValue = 0;
        
        foreach ($resultArr as $key => $item) {
           $wordValue+=($key*$item);
        }
        
        return round($wordValue/$this->globalWordCounter($resultArr), 3);
    }
    
    public function biggestValueFinder(array $resultArr)
    {
        $result = [];
        arsort($resultArr);
        $secondValue = next($resultArr);

        if (reset($resultArr) == $secondValue){
            $tmpArr = [];
            foreach ($resultArr as $key => $item) {
                if (!isset($tmpArr[$item])) {
                    $tmpArr[$item] = [];
                }
                $tmpArr[$item][] = $key;
            }
            $result[reset($resultArr)] = $tmpArr[reset($resultArr)];
        } else {
            $result[array_key_first($resultArr)] = [reset($resultArr)];
        }
       
        return $result;
    }
}