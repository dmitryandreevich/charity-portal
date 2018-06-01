<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 26.05.2018
 * Time: 19:35
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block new-org">
        @include('profile.consumer.blocks.topMenu')
        <div class="new-org_content">
            <div class="container">
                <h2 class="title">Новая потребность</h2>
                <form class="new-org__form"  method="post" action="{{ route('needs.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="list w50">
                        <select placeholder="Организация" name="organization" class="headroom_city sources custom-select">
                            @foreach($orgs as $org)
                                <option value="{{ $org->id }}" class="selection">{{ $org->name }}</option>
                            @endforeach
                        </select>
                        <select placeholder="Тип потребности" name="type_need" class="headroom_city sources custom-select select-need_type">
                            <option tab-name="tab-new_money" value="{{ \App\Classes\TypeOfNeed::COLLECT_MONEY }}">Сбор денег</option>
                            <option tab-name="tab-new_vols" value="{{ \App\Classes\TypeOfNeed::VOLUNTEERS }}">Помощь волонтёров</option>
                        </select>
                    </div>

                    <div class="tab-new_money" style="">
                        <div class="list">
                            <input type="text" placeholder="Заголовок" name="title">
                        </div>
                        <div class="list row">
                            <input type="text" placeholder="Ссылка на товар" name="link">
                            <input type="number" placeholder="Необходимая сумма" name="amount">
                        </div>
                        <div class="list">
                            <textarea placeholder="Описание потребности" name="description"></textarea>
                        </div>
                        <div class="add-file">
                            <div class="file-upload">
                                <label>
                                    <input type="file" name="cover"><span>Загрузить обложку.</span>
                                </label>
                            </div>
                            <div class="file-upload">
                                <label>
                                    <input type="file" name="doc"><span>Загрузить документ.Файл для сбора денег. Например, смета по ремонту.</span>
                                </label>
                            </div>
                        </div>
                        <div class="btn-block">
                            <input type="submit" value="Разместить">
                        </div>
                    </div>

                </form>
                    <div class="tab-new_vols" style="display: none">
                        <div class="list">
                            <input type="text" placeholder="Заголовок" name="title">
                        </div>
                        <div class="list">
                            <input type="text" placeholder="Дата, время" name="date_time">
                        </div>
                        <div class="list row">
                            <input type="number" placeholder="Количество волонтёров" name="count_vols">
                        </div>
                        <div class="list">
                            <textarea placeholder="Описание потребности" name="description"></textarea>
                        </div>
                        <div class="add-file">
                            <div class="file-upload">
                                <label>
                                    <input type="file" name="cover"><span>Загрузить обложку.</span>
                                </label>
                            </div>
                            <div class="file-upload">
                                <label>
                                    <input type="file" name="doc"><span>Загрузить документ.Файл для сбора денег. Например, смета по ремонту.</span>
                                </label>
                            </div>
                        </div>
                        <div class="btn-block">
                            <input type="submit" value="Разместить">
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
