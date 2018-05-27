<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 22.05.2018
 * Time: 18:55
 */
?>
@extends('layouts.app')

@section('main-block')
    <div class="main-block catalog">
        <div class="headroom">
            <div class="container">
                <h2 class="title">Каталог организаций</h2>
                <ul class="headroom_list row">
                    <li class="headroom_item big">
                        <select placeholder="Город" name="city" class="headroom_city sources custom-select big sort-select sort_city">
                            <option>Омск</option>
                            <option>Москва</option>
                            <option>Питер</option>
                        </select>
                    </li>
                    <li class="headroom_item big">
                        <select placeholder="Тип организации" name="type_consumer" class="type sources custom-select big sort-select sort-type_org">
                            @foreach(\App\Classes\TypesOfOrganizations::typesOrganizations as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li class="headroom_item big">
                        <select placeholder="Вид потребностей" name="view" class="view sources custom-select big sort-select sort-type_need">
                            <option value="{{ \App\Classes\TypeOfNeed::COLLECT_MONEY }}">Сбор денег</option>
                            <option value="{{ \App\Classes\TypeOfNeed::VOLUNTEERS }}">Помощь волонтёров</option>
                        </select>
                    </li>
                    <li class="headroom_item select-small">
                        <select placeholder="По дате добавления" name="date" class="sources custom-select big">
                            <option>По дате добавления</option>
                            <option>По дате добавления</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
        <div class="block-needs--help catalog_flex">
            <div class="container">
                <div class="slider_content page">
                    <div class="main-slider_item"><img src="./img/content/main-slider/item1.png">
                        <div class="content">
                            <div class="name">Детский дом-интернат #7</div>
                            <div class="bottom">
                                <div class="location">Уфа</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item2.png">
                        <div class="content">
                            <div class="name">Социально-реабилитационный центр</div>
                            <div class="bottom">
                                <div class="location">Норильск</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item3.png">
                        <div class="content">
                            <div class="name">Архангельский дом престарелых</div>
                            <div class="bottom">
                                <div class="location">Сертолов</div>
                                <div class="help"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item1.png">
                        <div class="content">
                            <div class="name">Детский дом-интернат #7</div>
                            <div class="bottom">
                                <div class="location">Уфа</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item2.png">
                        <div class="content">
                            <div class="name">Социально-реабилитационный центр</div>
                            <div class="bottom">
                                <div class="location">Норильск</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item3.png">
                        <div class="content">
                            <div class="name">Архангельский дом престарелых</div>
                            <div class="bottom">
                                <div class="location">Сертолов</div>
                                <div class="help"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item1.png">
                        <div class="content">
                            <div class="name">Детский дом-интернат #7</div>
                            <div class="bottom">
                                <div class="location">Уфа</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item2.png">
                        <div class="content">
                            <div class="name">Социально-реабилитационный центр</div>
                            <div class="bottom">
                                <div class="location">Норильск</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item3.png">
                        <div class="content">
                            <div class="name">Архангельский дом престарелых</div>
                            <div class="bottom">
                                <div class="location">Сертолов</div>
                                <div class="help"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item1.png">
                        <div class="content">
                            <div class="name">Детский дом-интернат #7</div>
                            <div class="bottom">
                                <div class="location">Уфа</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item2.png">
                        <div class="content">
                            <div class="name">Социально-реабилитационный центр</div>
                            <div class="bottom">
                                <div class="location">Норильск</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item3.png">
                        <div class="content">
                            <div class="name">Архангельский дом престарелых</div>
                            <div class="bottom">
                                <div class="location">Сертолов</div>
                                <div class="help"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item1.png">
                        <div class="content">
                            <div class="name">Детский дом-интернат #7</div>
                            <div class="bottom">
                                <div class="location">Уфа</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item2.png">
                        <div class="content">
                            <div class="name">Социально-реабилитационный центр</div>
                            <div class="bottom">
                                <div class="location">Норильск</div>
                                <div class="help"><img src="./img/icons/i.slider-help_services.svg"><img src="./img/icons/i.slider_help_people.svg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider_item"><img src="./img/content/main-slider/item3.png">
                        <div class="content">
                            <div class="name">Архангельский дом престарелых</div>
                            <div class="bottom">
                                <div class="location">Сертолов</div>
                                <div class="help"><img src="./img/icons/i.slider_help_things.svg"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="pagination(event)" class="paginator"></div>
            </div>
        </div>
    </div>
@endsection
