<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 01.06.2018
 * Time: 17:15
 */
?>

@foreach($needs as $need)
    @php $user = \Illuminate\Support\Facades\Auth::user(); @endphp
    <div class="content__item row">
        <div class="left"><img src="{{ asset("storage/$need->cover_path") }}"></div>
        <div class="right">
            <div class="info">
                <a href="{{ route('organizations.show', ['id' => $need->id_org]) }}" target="_blank"><h3 class="name">{{ $need->title }}</h3></a>
                <h3 class="name">{{ $need->orgName or "" }}</h3>
                <p class="html">{{ $need->description }}</p>
                <div class="bottom_item row">
                    <div class="date descr">Дата создания: <span class="bold">{{ $need->created_at }}</span></div>
                    <div class="author descr">Координатор: <span class="bold">Иван Викторов</span></div>
                </div>
            </div>
            <div class="end">
                <div class="info">
                    <div class="p-small">Нужно волонтёров:<span>{{ $need->count_vols }} человек</span></div>
                    <span class="money">Осталось собрать:<span class="blue">{{ $need->count_vols - $need->collected }} человек</span></span>
                </div>
            </div>
        </div>
        <div class="circle {{ \App\Classes\StatusOfNeed::getColorStatus($need->status) }}">
        </div>
    </div>
@endforeach