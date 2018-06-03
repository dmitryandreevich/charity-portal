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
        <h4 class="title">Заявки на новые организации</h4>
    </div>
    @foreach($organizations as $organization)
        <div class="content__item row">
            <div class="left"><img src="{{ asset("storage/$organization->cover_path") }}"></div>
            <div class="right">
                <div class="info">
                    <a href="{{ route('organizations.show',['organization' => $organization->id]) }}"><h3 class="name">{{ $organization->name }}</h3></a>
                    <div class="location">{{ $organization->address }}</div>
                </div>
                <div class="btn-block"><a href="" class="btn blue">Заблокировать</a></div>
                <div class="btn-block"><a href="" class="btn blue">Принять</a></div>

            </div>
        </div>
    @endforeach

    <div class="top">
        <h4 class="title">Жалобы на потребности</h4>
    </div>
    @foreach($needs as $need)
        @php $typeOfNeed = $need->type_need; @endphp

        @if($typeOfNeed == \App\Classes\TypeOfNeed::VOLUNTEERS)
            <div class="content__item row">
                <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
                <div class="right">
                    <div class="info">
                        <h3 class="name">{{ $need->title }}</h3>
                        <p class="html">{{ $need->description }}</p>
                    </div>
                    <div class="end">
                        <div class="info">
                            <div class="btn-block">
                                <a href="#" data-modal="#modal3" class="btn blue open-modal" receiver="{{ $need->id }}" >Отменить заявку</a>
                            </div>
                        </div>
                    </div>
                    <div class="end">
                        <div class="info">
                            <div class="btn-block">
                                <a href="#" data-modal="#modal3" class="btn blue open-modal" receiver="{{ $need->id }}" >Заблокировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($typeOfNeed == \App\Classes\TypeOfNeed::COLLECT_MONEY)
            <div class="content__item row">
                <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
                <div class="right">
                    <div class="info">
                        <h3 class="name">{{ $need->title }}</h3>
                        <p class="html">{{ $need->description }}</p>
                        <a href="{{ $need->link }}" class="link">{{ $need->link }}</a>
                    </div>
                    <div class="end">
                        <div class="info">
                            <div class="btn-block">
                                <a href="#" data-modal="#modal3" class="btn blue open-modal" receiver="{{ $need->id }}" >Отменить заявку</a>
                            </div>
                        </div>
                    </div>
                    <div class="end">
                        <div class="info">
                            <div class="btn-block">
                                <a href="#" data-modal="#modal3" class="btn blue open-modal" receiver="{{ $need->id }}" >Заблокировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection


