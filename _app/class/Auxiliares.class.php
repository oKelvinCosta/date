<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 06/03/2017
 * Time: 19:57
 */
class Auxiliares
{
    private static $Data;
    private static $Format;


    // Separa em palavras
    public static function Words($String, $Limit, $Pointer = null){
        self::$Data = $String;
        self::$Format = $Limit;

        $Arr = explode(" ", self::$Data);
        $ArrCount = count($Arr);

        $NewString = implode(" ", array_slice($Arr, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer);

        $Result = (self::$Format < $ArrCount ? $NewString . $Pointer : self::$Data);

        return $Result;

    }
}