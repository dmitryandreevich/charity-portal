<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 22.05.2018
 * Time: 21:00
 */

namespace App\Classes;


class TypeOfUser
{
    const DONOR = 0;
    const CONSUMER = 1;
    const VOLUNTEER = 2;
    const MODERATOR = 3;
    const ADMINISTRATOR = 4;

    const NAMES = ['Донор', 'Потребитель', 'Волонтёр','Модератор', 'Администратор'];
}