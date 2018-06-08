<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 25.05.2018
 * Time: 19:30
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block sp needs">
        <div class="main-banner"></div>
        <div class="main-content">
            <div class="container">
                <div class="top">
                    <h2 class="title">{{ $data['name'] }}</h2>
                    <div class="location">{{ $data['address'] }}</div>
                </div>
                <p class="descr">{{ $data['description'] }}</p>
                <div class="main-slider">
                    <div class="container">
                        <div class="main-slider_header row"></div>
                        <div class="main-slider_content">
                            @foreach($photos as $photo)
                                <div class="main-slider_item">@php echo sprintf('<img src="data:image/png;base64,%s" />', $photo) @endphp</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="block-needs--help">
                    <div class="container">
                        <div class="slider_content">
                            <div class="main-slider_item"><img src="./img/content/sp/img_item1.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item2.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item3.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item1.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item2.png"></div>
                            <div class="main-slider_item"><img src="./img/content/sp/img_item3.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog_organization-content">
            <div class="container">
                <div class="top">
                    <div class="left">
                        <h2 class="title">Актуальные потребности</h2><a href="/">Архив</a>
                    </div>

                </div>
                <div class="content__list">
                    <div class="content__item row">
                        <h3 class="title">Здесь будут находится ваши потребности</h3>
                    </div>
                    <div class="content__item row">
                        <h3 class="title">Здесь будут находится ваши потребности</h3>
                    </div>
                    <div class="content__item row">
                        <h3 class="title">Здесь будут находится ваши потребности</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
