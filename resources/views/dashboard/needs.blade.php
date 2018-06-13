<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 03.06.2018
 * Time: 13:07
 */
?>
@extends('dashboard.layout')
@section('page-title', 'Админ-панель - Все потребности на портале')

@section('dashboard-block')
   @include('dashboard.blocks.tableNeeds')

@endsection

