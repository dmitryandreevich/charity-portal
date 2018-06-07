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
                <a href="{{ asset("storage/$organization->doc_path") }}" class="link">Скачать документ организации</a>

                <div class="btn-block"><a href="{{ route('dashboard.moderation.org.block', ['organization' => $organization->id]) }}" class="btn blue" name="block">Заблокировать</a></div>
                <div class="btn-block"><a href="{{ route('dashboard.moderation.org.apply', ['organization' => $organization->id]) }}" class="btn blue" name="apply">Принять</a></div>

            </div>
        </div>
    @endforeach

    <div class="top">
        <h4 class="title">Жалобы на потребности</h4>
    </div>


    <table width="100%">
        <tr>
            <th>Id отправителя</th>
            <th>Id потребности</th>
            <th>Сообщение</th>
            <th colspan="2">Операции</th>
        </tr>
        @foreach($reports as $report)
            <tr>
                <td>{{ $report->id_sender }}</td>
                <td>{{ $report->id_need }}</td>
                <td>{{ $report->message }}</td>
                <td><a href="{{ route('dashboard.moderation.need.block', ['need' => $report->id_need]) }}" style="color: black">Заблокировать</a></td>
                <td><a href="{{ route('organizations.show', ['organization' => $report->id_org]) }}" style="color:black">Перейти</a></td>
            </tr>
        @endforeach
    </table>
    <!--@foreach($needs as $need)
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
        -->

@endsection


