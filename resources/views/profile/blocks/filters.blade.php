<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 01.06.2018
 * Time: 16:35
 */
?>

<div class="filters">

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
    @if(\Illuminate\Support\Facades\Auth::user()->type == \App\Classes\TypeOfUser::DONOR)
        <select placeholder="Тип" name="city" class="headroom_city sources custom-select sort-select-needs filter_type-donate">
            @for($i = 0; $i < count(\App\Classes\TypeOfDonate::NAMES); $i++)
                <option value="{{ $i }}">{{ \App\Classes\TypeOfDonate::NAMES[$i] }}</option>
            @endfor
        </select>
    @endif
    @if(\Illuminate\Support\Facades\Auth::user()->type == \App\Classes\TypeOfUser::CONSUMER)
        <select placeholder="тип" name="city" class="headroom_city sources custom-select sort-select-needs filter_type-need">
            @for($i = 1; $i < count(\App\Classes\TypeOfNeed::NAMES); $i++)
                <option value="{{ $i }}">{{ \App\Classes\TypeOfNeed::NAMES[$i] }}</option>
            @endfor
        </select>
    @endif
</div>