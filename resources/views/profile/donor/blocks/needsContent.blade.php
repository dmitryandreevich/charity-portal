<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 01.06.2018
 * Time: 15:29
 */
?>

@foreach($needs as $need)
    @php $user = \Illuminate\Support\Facades\Auth::user();  @endphp

    <div class="content__item row">
        <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
        <div class="right">
            <div class="info">
                <a href="{{ route('organizations.show', ['id' => $need->id_org]) }}" target="_blank"><h3 class="name">{{ $need->title }}</h3></a>
                <h3 class="name">{{ $need->orgName or "" }}</h3>
                <p class="html">{{ $need->description }}</p>
            </div>
            @if( ($need->amount - $need->collected ) <= 0.00 )
                <div class="end">
                    <span class="money">Вся сумма собрана<span class="green">{{ $need->amount }} ₽</span></span>
                </div>
            @else
                <div class="end">
                    <div class="info">
                        <div class="p-small">Необходимая сумма:<span>{{ $need->amount }} ₽</span></div><span class="money">Осталось собрать:<span class="blue">{{ $need->amount - $need->collected }} ₽</span></span>
                    </div>
                    @if($need->status == \App\Classes\StatusOfNeed::STATUS_ACTUAL)
                       <!-- <div class="btn-block"><a href="#" data-modal="#modal3" class="btn blue open-modal" receiver="{{ $need->id }}">Помочь</a></div>
                    @endif
                    -->
                </div>
            @endif
        </div>
        <div class="circle {{ \App\Classes\StatusOfNeed::getColorStatus($need->status) }}"></div>
    </div>
@endforeach