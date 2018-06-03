<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 02.06.2018
 * Time: 21:25
 */
?>
@extends('dashboard.layout')

@section('dashboard-block')
        <table width="100%">
            <tr>
                <th>Id пользователя</th>
                <th>Email</th>
                <th>Город</th>
                <th>Телефон</th>
                <th>Тип</th>
                <th>переход</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ \App\Classes\TypeOfUser::NAMES[$user->type] }}</td>
                    <td><a href="{{ route('dashboard.users.show', ['user' => $user->id]) }}">Перейти</a></td>
                </tr>
            @endforeach
        </table>
@endsection

