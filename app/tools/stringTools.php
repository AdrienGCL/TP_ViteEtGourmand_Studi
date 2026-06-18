<?php

namespace App\Tools;

class StringTools
{
    public static function IdConverter(string $idlabel):string
    {
        if(str_contains($idlabel, 'id')){
            $charLength = strlen($idlabel);
            $charNumber = $charLength - 2;
            $newlabel = substr($idlabel, $charNumber);

            return $newlabel;
        }
        else{
            return $idlabel;
        }
    }

    public static function getFirstLetter(string $word):string
    {
        $firstLetter = substr($word, 0, 1);
        return $firstLetter;
    }

    public static function toUpperCase(string $word):string
    {
        $newWord = strtoupper($word);
        return $newWord;
    }
}