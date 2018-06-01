<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 01.06.2018
 * Time: 16:52
 */?>
@foreach($needs as $need)
    @php $user = \Illuminate\Support\Facades\Auth::user(); $typeOfNeed = $need->type_need; @endphp

    @if($typeOfNeed == \App\Classes\TypeOfNeed::VOLUNTEERS)
        <div class="content__item row">
            <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
            <div class="right">
                <div class="info">
                    <h3 class="name">{{ $need->title }}</h3>
                    <h3 class="name">{{ $need->orgName or "" }}</h3>
                    <h3 class="name">Сбор волонтёров</h3>
                    <p class="html">{{ $need->description }}</p>
                    <div class="bottom_item row">
                        <div class="date descr">Дата создания: <span class="bold">{{ $need->created_at }}</span></div>
                        <div class="author descr">Координатор: <span class="bold">Иван Викторов</span></div>
                    </div>
                </div>
                <div class="end">
                    <div class="info">
                        <div class="p-small">Нужно волонтёров:<span>{{ $need->count_vols }} человек</span></div><span class="money">Осталось собрать:<span class="blue">{{ $need->count_vols - $need->collected }} человек</span></span>
                    </div>
                    @if($need->status == \App\Classes\StatusOfNeed::STATUS_ACTUAL)
                        <div class="btn-block">
                            <a href="#" data-modal="#modalCancelNeed" class="btn blue open-modal" receiver="{{ $need->id }}">Отменить</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="circle {{ \App\Classes\StatusOfNeed::getColorStatus($need->status) }}">
            </div>
        </div>
    @elseif($typeOfNeed == \App\Classes\TypeOfNeed::COLLECT_MONEY)
        <div class="content__item row">
            <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
            <div class="right">
                <div class="info">
                    <a href="{{ route('organizations.show', ['id' => $need->id_org]) }}" target="_blank"><h3 class="name">{{ $need->title }}</h3></a>
                    <h3 class="name">{{ $need->orgName or "" }}</h3>
                    <h3 class="name">Сбор средств</h3>
                    <p class="html">{{ $need->description }}</p>
                </div>
                @if( ($need->amount - $need->collected ) <= 0.00 )
                    <div class="end">
                        <span class="money">Вся сумма собрана<span class="green">{{ $need->amount }} ₽</span></span>
                        <div class="btn-block"><a href="#" data-modal="#modal3" class="btn blue open-modal">Получить</a></div>
                    </div>
                @else
                    <div class="end">
                        <div class="info">
                            <div class="p-small">Необходимая сумма:<span>{{ $need->amount }} ₽</span></div><span class="money">Осталось собрать:<span class="blue">{{ $need->amount - $need->collected }} ₽</span></span>
                        </div>
                        @if($need->status == \App\Classes\StatusOfNeed::STATUS_ACTUAL)
                            <div class="btn-block">
                                <a href="#" data-modal="#modalCancelNeed" class="btn blue open-modal" receiver="{{ $need->id }}">Отменить</a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            <div class="circle {{ \App\Classes\StatusOfNeed::getColorStatus($need->status) }}">
            </div>
        </div>
    @endif
@endforeach
