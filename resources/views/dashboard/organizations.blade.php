<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 02.06.2018
 * Time: 12:01
 */
?>
@extends('dashboard.layout')
@section('page-title', 'Админ-панель - Все организации на портале')
@section('dashboard-block')
  @include('dashboard.blocks.tableOrganizations')

@endsection
