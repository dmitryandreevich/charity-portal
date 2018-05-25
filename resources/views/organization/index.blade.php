<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 25.05.2018
 * Time: 19:34
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block catalog_organization">
        @include('profile.consumer.topMenu')
        <div class="catalog_organization-content">
            <div class="container">
                <h2 class="title">Мои организации</h2>
                <div class="content__list">
                    @foreach($organizations as $organization)
                        <div class="content__item row">
                            <div class="left"><img src="{{ asset("storage/$organization->cover_path") }}"></div>
                            <div class="right">
                                <div class="info">
                                    <a href="{{ route('organizations.show',['organization' => $organization->id]) }}"><h3 class="name">{{ $organization->name }}</h3></a>
                                    <div class="location">{{ $organization->address }}</div>
                                </div>
                                <div class="btn-block"><a href="" class="btn blue">Редактировать</a></div>
                                @php $st = $organization->status; @endphp
                                <div class="circle {{ $st === 0 ? "red" : ($st === 1 ? 'yellow' : 'green') }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
