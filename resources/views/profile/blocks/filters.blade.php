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
</div>