<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 14.06.2018
 * Time: 11:44
 */

namespace App\Classes;


class ValidateMessages
{
    const ORGANIZATION_STORE = [
        'cover.required' => 'Вы не выбрали обложку.',
        'cover.image' => 'Обложка должна быть картинкой.',
        'cover.max' => 'Превышен максимальный размер обложки. Макс. - :max',

        'docs.required' => 'Вы не выбрали документ.',
        'docs.file' => 'Документ должен быть файлом.',
        'docs.max' => 'Превышен максимальный размер документа. Макс. - :max',

        'photos.required' => 'Выберите фотографии для организации.',
        'address.required' => 'Вы не указали адрес.',
        'name.required' => 'Вы не указали имя организации.',
        'name.max' => 'Максимальное количество символов в имени - :max',

        'description.required' => 'Поле описание, является обязательным для заполнения.',
        'description.between' => 'Размер описания должен быть :min - :max символов.',

    ];

    const NEED_STORE = [
      'title.required' => 'Заголовок должен быть введён.',
        'title.between' => 'Размер заголовка должен быть :min - :max символов.',
        'amount.required' => 'Введите сумму сбора.',
        'amount.integer' => 'Сумма сбора должна быть цифрой.',

        'cover.required' => 'Вы не выбрали обложку.',
        'cover.image' => 'Обложка должна быть картинкой.',
        'cover.max' => 'Превышен максимальный размер обложки. Макс. - :max',

        'doc.required' => 'Вы не выбрали документ.',
        'doc.file' => 'Документ должен быть файлом.',
        'doc.max' => 'Превышен максимальный размер документа. Макс. - :max',

        'link.required' => 'Вы не ввели ссылку.',
        'link.string' => 'Ссылка должна быть строкой.',
        'date_time.required' => 'Вы не ввели дату и время проведения.',
        'date_time.string' =>'Дата и время должны быть строкой.',
        'date_time.max' => 'Превышен размер строки даты и времени. Макс. - :max.',
        'count_vols.required' => 'Вы не ввели необходимое количество волонтёров.',
        'count.integer' => 'Количество волонтёров должно быть цифрой.',
        'description.required' => 'Поле описание, является обязательным для заполнения.',
        'description.between' => 'Размер описания должен быть :min - :max символов.',

    ];
}

