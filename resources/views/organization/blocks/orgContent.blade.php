<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 05.06.2018
 * Time: 16:28
 */
?>
@foreach($needs as $need)
    @php $typeOfNeed = $need->type_need; @endphp

    @if($typeOfNeed == \App\Classes\TypeOfNeed::VOLUNTEERS)
        <div class="content__item row">
            <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
            <div class="right">
                <div class="info">
                    <h3 class="name">{{ $need->title }}</h3>
                    <p class="html">{{ $need->description }}</p>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="#" data-modal="#modalReportNeed" class="link open-modal" receiver="{{ $need->id }}">Пожаловаться</a>
                    @endif
                    <div class="bottom_item row">
                        <div class="date descr">Дата: <span class="bold">{{ $need->date_time }}</span></div>
                    </div>
                </div>
                @if( ($need->count_vols - $need->collected) <= 0)
                    <div class="end">
                        <div class="info">
                            <span class="money">Все волонтёры собраны<span class="green">{{ $need->count_vols }}</span></span>

                        </div>
                    </div>
                @else
                    <div class="end">
                        <div class="info">
                            <div class="p-small">Нужно волонтёров:<span>{{ $need->count_vols }} человек</span></div>
                            <span class="money">Осталось собрать:<span class="blue">{{ $need->count_vols - $need->collected }} человек</span></span>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @php
                                $user = \Illuminate\Support\Facades\Auth::user();
                                $userData =  \App\User::getData($user);
                            @endphp

                            @if($user->type == \App\Classes\TypeOfUser::VOLUNTEER)
                                @if($need->isVolunteer)
                                    <div class="info">
                                        <div class="p-small">Вы уже являетесь волонтёром этой потребности!</div>
                                    </div>
                                @else
                                    @if($need->status == \App\Classes\StatusOfNeed::STATUS_ACTUAL)
                                        @if($userData->individual->active)
                                            <div class="info">
                                                <div class="btn-block">
                                                    <a href="{{ route('volunteer.add', ['need' => $need->id]) }}" class="btn blue">Помочь</a>
                                                </div>
                                            </div>

                                        @elseif($userData->organization->active)
                                            <div class="info">
                                                <div class="btn-block">
                                                    <a href="#" data-modal="#modal4" class="btn blue open-modal" receiver="{{ $need->id }}">Помочь</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @else
                            <div class="info">
                                <div class="p-small">
                                    <div class="btn-block">
                                        <a href="#" data-modal="#modal6" class="btn blue open-modal">Войти</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            <div class="circle {{ \App\Classes\StatusOfNeed::getColorStatus($need->status) }}"></div>
        </div>
    @elseif($typeOfNeed == \App\Classes\TypeOfNeed::COLLECT_MONEY)
        <div class="content__item row">
            <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
            <div class="right">
                <div class="info">
                    <h3 class="name">{{ $need->title }}</h3>
                    <p class="html">{{ $need->description }}</p>
                    <a href="#" data-modal="#modalReportNeed" class="link open-modal" receiver="{{ $need->id }}">Пожаловаться</a>
                </div>
                @if( ($need->amount - $need->collected ) <= 0 )
                    <div class="end">
                        <span class="money">Вся сумма собрана<span class="green">{{ $need->amount }} ₽</span></span>
                    </div>
                @else
                    <div class="end">
                        <div class="info">
                            <div class="p-small">Необходимая сумма:<span>{{ $need->amount }} ₽</span></div><span class="money">Осталось собрать:<span class="blue">{{ $need->amount - $need->collected }} ₽</span></span>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if(\Illuminate\Support\Facades\Auth::user()->type == \App\Classes\TypeOfUser::DONOR && $need->status == \App\Classes\StatusOfNeed::STATUS_ACTUAL)
                                <div class="btn-block">
                                    <a href="#" data-modal="#modal3" class="btn blue open-modal" receiver="{{ $need->id }}" >Помочь</a>
                                </div>
                            @endif
                        @else
                            <div class="info">
                                <div class="p-small">
                                    <div class="btn-block">
                                        <a href="#" data-modal="#modal6" class="btn blue open-modal">Войти</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            <div class="circle {{ \App\Classes\StatusOfNeed::getColorStatus($need->status) }}"></div>
        </div>
    @endif
@endforeach
