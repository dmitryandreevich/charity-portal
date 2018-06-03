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
            <th>переход</th>
        </tr>
        @foreach($orgs as $org)
            <tr>
                <td>{{ $org->id }}</td>
                <td>{{ $org->creator }}</td>
                <td>{{ \App\Classes\StatusOfOrganization::NAMES[$org->status] }}</td>
                <td>{{ \App\Classes\TypesOfOrganizations::typesOrganizations[$org->type_consumer] }}</td>
                <td>{{ $org->city }}</td>
                <td>{{ $org->name }}</td>
                <td><a href="{{ route('organizations.show', ['organization' => $org->id]) }}">Перейти</a></td>
            </tr>
        @endforeach
    </table>

@endsection
