<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 02.06.2018
 * Time: 21:25
 */
?>
@extends('dashboard.layout')
@section('page-title', 'Админ-панель - Все пользователи')

@section('dashboard-block')
     @include('dashboard.blocks.tableUsers')
@endsection

