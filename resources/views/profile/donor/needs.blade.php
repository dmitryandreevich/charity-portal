<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 27.05.2018
 * Time: 13:54
 */
?>
@extends('layouts.app')
@section('page-title', 'Потребности с вашим участием')
@section('main-block')
    <div class="main-block needs">
        @include('profile.donor.blocks.topMenu')
        <div class="catalog_organization-content">
            <div class="container">
                <div class="top">
                    <h2 class="title">Потребности</h2>
                    <div class="select">
                        @include('profile.blocks.filters')

                    </div>
                </div>
                <div class="content__list">
                    @include('profile.donor.blocks.needsContent')
                </div>
            </div>
        </div>
    </div>
@endsection