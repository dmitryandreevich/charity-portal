<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 02.06.2018
 * Time: 12:01
 */
?>
@extends('dashboard.layout')

@section('dashboard-block')
    <table width="100%">
        <tr>
            <th>Id организации</th>
            <th>Id создателя</th>
            <th>Статус</th>
            <th>Тип потребителя</th>
            <th>Город</th>
            <th>Имя</th>
            <th colspan="2">Операции</th>

        </tr>
        @foreach($orgs as $org)
            <tr>
                <td>{{ $org->id }}</td>
                <td>{{ $org->creator }}</td>
                <td>{{ \App\Classes\StatusOfOrganization::NAMES[$org->status] }}</td>
                <td>{{ \App\Classes\TypesOfOrganizations::typesOrganizations[$org->type_consumer] }}</td>
                <td>{{ $org->city }}</td>
                <td>{{ $org->name }}</td>
                @if($org->status == \App\Classes\StatusOfOrganization::DISABLED_BY_MODERATOR)
                    <td>
                        <a href="{{ route('dashboard.moderation.org.unblock', ['organization' => $org->id]) }}" style="color:black">Разблокировать</a>
                    </td>
                @else
                    <td>
                        <a href="{{ route('dashboard.moderation.org.block', ['organization' => $org->id]) }}" style="color:black">Заблокировать</a>
                    </td>
                @endif

                <td>
                    <a href="{{ route('organizations.show', ['organization' => $org->id]) }}" style="color:black">Перейти</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
