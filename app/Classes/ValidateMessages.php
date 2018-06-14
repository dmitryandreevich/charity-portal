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

    const PROFILE_UPDATE = [
      'email.unique' => ':input уже используется другим пользователем. Введите другой email.'
    ];

    const DONOR_DONATION_FINANCE = [
        'amount.required' => 'Вы не ввели сумму пожертвования.',
        'amount.integer' => 'Сумма пожертвования должна быть числом.',
    ];
    const DONOR_DONATION_MATERIAL = [
        'info.required' => 'Вы не ввели информацию о пожертвовании.',
    ];
    const PROFILE_CHANGE_PASSWORD = [
        'newPassword.confirmed' => 'Вы не подтвердили введённый пароль.',
        'newPassword.between' => 'Размер пароля должен быть от :min до :max символов.'
    ];
    const REPORT_SEND = [
        'reportMessage.required' => 'Введите причину жалобы.'
    ];
    const REGISTER = [
        'email.email' => 'Email должен быть формата email.',
        'email.string' => 'Email должен быть строкой.',
        'email.max' => 'Длина email адреса не должна превышать :max символов.',
        'email.unique' => 'Email :input уже зарегистрирован на портале.',
        'password.required' => 'Пароль должен быть введён.',
        'password.string' => 'Пароль должен быть строкой.',
        'password.min' => 'Длина пароля должна быть минимум :min.',
        'password.confirmed' => 'Пароль и подтверждение пароля не совпадают.'
    ];
}

/*
 *
 * 'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'typeOfUser' => 'required|max:2',
 * */