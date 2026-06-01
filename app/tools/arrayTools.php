<?php

namespace app\tools;

class ArrayTools
{
    public static function addFromArray(array $sourceArray, array $resultArray):array
    {
        foreach($sourceArray as $value){
            if(in_array($value, $resultArray)){
                // Ne rien faire
            }
            else {
                array_push($resultArray, $value);
            }
        }
        return $resultArray;
    }
}