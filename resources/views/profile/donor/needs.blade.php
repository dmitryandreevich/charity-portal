<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 27.05.2018
 * Time: 13:54
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block needs">
        @include('profile.donor.blocks.topMenu')
        <div class="catalog_organization-content">
            <div class="container">
                <div class="top">
                    <h2 class="title">Потребности с вашим участием</h2>
                    <div class="select">
                        <select placeholder="Статус" name="city" class="headroom_city sources custom-select sort-select-needs filter_status">
                            <option value="{{ \App\Classes\StatusOfNeed::STATUS_ACTUAL }}">Актуальные</option>
                            <option value="{{ \App\Classes\StatusOfNeed::STATUS_COLLECTED }}">Собранные</option>
                            <option value="{{ \App\Classes\StatusOfNeed::STATUS_ARCHIVE }}">В архиве</option>
                            <option value="{{ \App\Classes\StatusOfNeed::STATUS_BLOCK }}">Заблокированные</option>
                        </select>
                        <select placeholder="Организация" name="city" class="headroom_city sources custom-select sort-select-needs filter_organization">
                            @foreach($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="content__list">
                    @include('profile.donor.blocks.needsContent')
                </div>
            </div>
        </div>
    </div>
@endsection