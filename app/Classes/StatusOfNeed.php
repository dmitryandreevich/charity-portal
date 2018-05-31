<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 26.05.2018
 * Time: 19:17
 */

namespace App\Classes;


use App\Need;

class StatusOfNeed
{
    const STATUS_ACTUAL = 1;
    const STATUS_ARCHIVE = 2;
    const STATUS_BLOCK = 3;
    const STATUS_COLLECTED = 4;

    public static function setStatusNeed(Need $need, $statusCode){
        $need->status = $statusCode;
        return $need->save();
    }
    public static function getColorStatus($needStatus){
        switch ($needStatus){
            case \App\Classes\StatusOfNeed::STATUS_ACTUAL:
                return "green";
            case \App\Classes\StatusOfNeed::STATUS_ARCHIVE:
                return "yellow";
            case \App\Classes\StatusOfNeed::STATUS_BLOCK:
                return "red";
            case \App\Classes\StatusOfNeed::STATUS_COLLECTED:
                return "green";
        }
        return 'red';
    }
}