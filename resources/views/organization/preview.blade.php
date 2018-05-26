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
                    <h2 class="title"></h2>
                    <div class="location"></div>
                </div>
                <p class="descr"></p>
                <div class="main-slider">
                    <div class="container">
                        <div class="main-slider_header row"></div>
                        <div class="main-slider_content">
                                <div class="main-slider_item"><img src=""></div>
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
                    <div class="select">
                        <select placeholder="Тип потребности" name="city" class="headroom_city sources custom-select">
                            <option>Омск</option>
                            <option>Москва</option>
                            <option>Питер</option>
                        </select>
                    </div>
                </div>
                <div class="content__list">
                    <div class="content__item row">
                        <div class="left"><img src="./img/content/needs/item2_img.png"></div>
                        <div class="right">
                            <div class="info">
                                <h3 class="name">Заговок потребности</h3>
                                <p class="html">Кало́ши или гало́ши (Славянофилы — мокроступы) (фр. galoches и нем. Galoschen) — непромокаемые (обычно резиновые) накладки, надеваемые на обувь, некоторые виды используются как самостоятельная обувь</p><a href="https://www.wildberries.ru/catalog/5239840/detail.aspx" class="link">https://www.wildberries.ru/catalog/5239840/detail.aspx</a>
                            </div>
                            <div class="end">
                                <div class="info">
                                    <div class="p-small">Необходимая сумма:<span>30 000 ₽</span></div><span class="money">Осталось собрать:<span class="blue">12 760 ₽</span></span>
                                </div>
                                <div class="btn-block"><a href="#" data-modal="#modal3" class="btn blue open-modal">Помочь</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="content__item row">
                        <div class="left"><img src="./img/content/needs/item3_img.png"></div>
                        <div class="right">
                            <div class="info">
                                <h3 class="name">Заговок потребности</h3>
                                <p class="html">Кало́ши или гало́ши (Славянофилы — мокроступы) (фр. galoches и нем. Galoschen) — непромокаемые (обычно резиновые) накладки, надеваемые на обувь, некоторые виды используются как самостоятельная обувь</p>
                                <div class="bottom_item row">
                                    <div class="date descr">Дата: <span class="bold">20 апреля 2018</span></div>
                                </div>
                            </div>
                            <div class="end">
                                <div class="info">
                                    <div class="p-small">Нужно волонтёров:<span>15 человек</span></div><span class="money">Осталось собрать:<span class="blue">8 человек</span></span>
                                </div>
                                <div class="btn-block"><a href="#" data-modal="#modal4" class="btn blue open-modal">Помочь</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="content__item row">
                        <div class="left"><img src="./img/content/needs/item2_img.png"></div>
                        <div class="right">
                            <div class="info">
                                <h3 class="name">Заговок потребности</h3>
                                <p class="html">Кало́ши или гало́ши (Славянофилы — мокроступы) (фр. galoches и нем. Galoschen) — непромокаемые (обычно резиновые) накладки, надеваемые на обувь, некоторые виды используются как самостоятельная обувь</p>
                                <div class="file-upload">
                                    <label>
                                        <input type="file"><span>Скачать смету</span>
                                    </label>
                                </div>
                            </div>
                            <div class="end">
                                <div class="info">
                                    <div class="p-small">Необходимая сумма:<span>30 000 ₽</span></div><span class="money">Осталось собрать:<span class="blue">12 760 ₽</span></span>
                                </div>
                                <div class="btn-block"><a href="#" data-modal="#modal3" class="btn blue open-modal">Помочь</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
