<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 03.06.2018
 * Time: 13:07
 */
?>
@extends('dashboard.layout')

@section('dashboard-block')
    <table width="100%">
        <tr>
            <th>Id потребности</th>
            <th>Id организации</th>
            <th>Тип потребности</th>
            <th>Статус</th>
            <th>Переход на организацию</th>
        </tr>
        @foreach($needs as $need)
            <tr>
                <td>{{ $need->id }}</td>
                <td>{{ $need->id_org }}</td>
                <td>{{ \App\Classes\TypeOfNeed::NAMES[$need->type_need] }}</td>
                <td>{{ \App\Classes\StatusOfNeed::NAMES[$need->status] }}</td>
                <td><a href="{{ route('organizations.show', ['organization' => $need->id_org]) }}">Перейти</a></td>
            </tr>
        @endforeach
    </table>

@endsection

