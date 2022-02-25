<?php
namespace App\Helpers;

class ArrayHelper 
{
    public static function inLike($string, $arr)
    {
        $result = false;
        
        foreach($arr as $r){
            $result = str_contains($string, $r);
        }

        return $result;
    }
}