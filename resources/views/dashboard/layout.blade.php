<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 02.06.2018
 * Time: 12:15
 */
?>
@extends('layouts.app')


@section('main-block')
    <div class="main-block">
        @include('dashboard.blocks.topMenu')
        <div class="catalog_organization-content">
            <div class="container">
                <div class="top">
                    <h2 class="title">Панель управления</h2>
                </div>
                <div class="content__list">
                    @yield('dashboard-block')
                </div>
            </div>
        </div>
    </div>
@endsection
