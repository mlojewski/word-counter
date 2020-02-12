<?php

namespace App\service;

class WordStatCounter
{
    public function trimSpecialSigns(array $words): array
    {
        $trimmedWords = [];
        foreach ($words as $word){
        $trimmedWords[] = preg_replace('/[^A-Za-z0-9\-]/', '', $word);
        }
        return $trimmedWords;
    }
    
    public function countLetters(array $words)
    {
        $words = $this->trimSpecialSigns($words);
        $letterCount = [];
        foreach ($words as $word){
            $letterCount[] = strlen($word);
        }
        return $letterCount;
    }
}