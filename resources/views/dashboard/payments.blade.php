<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 03.06.2018
 * Time: 13:56
 */
?>

@extends('dashboard.layout')

@section('dashboard-block')

    <div class="top">
        <h4 class="title">Заявки на выплату</h4>
    </div>
    <table width="100%">
        <tr>
            <th>Id Отправителя</th>
            <th>Id Организации</th>
            <th>Id Потребности</th>
            <th>Сумма выплаты</th>
            <th>Операции</th>
        </tr>
        @foreach($requests as $request)
            <tr>
                <td><a href="{{ route('dashboard.users.show', ['user' => $request->id_sender]) }}">{{ $request->id_sender }}</a></td>
                <td><a href="{{ route('organizations.show', ['organization' => $request->id_org]) }}" style="color: #000000;">{{ $request->id_org }}</a></td>
                <td><a href="{{ route('organizations.show', ['organization' => $request->id_org]) }}" style="color: #000000;">{{ $request->id_need }}</a></td>
                <td>{{ $request->amount }} ₽</td>
                <td><a href="{{ route('dashboard.withdraw.mark', ['id' => $request->id]) }}" style="color:black">Отметить выплату</a></td>
            </tr>
        @endforeach
    </table>

@endsection


