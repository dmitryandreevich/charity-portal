<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 13:10
 */

namespace App\Classes;


use stdClass;

class Utils
{
    public static function getUserDataJsonTemplate(){
        return [
            'individual' => ['active' => true, 'data' => [ ]],
           'organization' => ['active' => false, 'data' => [ ]]
        ];
    }

}