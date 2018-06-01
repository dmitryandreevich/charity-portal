<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 29.05.2018
 * Time: 14:29
 */
?>

    <div class="container">
        <div class="slider_content page">

        @foreach($organizations as $organization)
                <div class="main-slider_item"><img src="{{ asset("storage/$organization->cover_path") }}">
                    <div class="content">
                        <a href="{{ route('organizations.show',['organization' => $organization->id]) }}"><div class="name">{{ $organization->name }}</div></a>
                        <div class="bottom">
                            <div class="location">{{ $organization->address }}</div>
                            <div class="help">
                                <img src="./img/icons/i.slider-help_services.svg">
                                <img src="./img/icons/i.slider_help_people.svg">
                                <img src="./img/icons/i.slider_help_things.svg">
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
        </div>

        <div onclick="pagination(event)" class="paginator"></div>

            <!--<div class="slider_content page">

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
            </div>-->
    </div>
