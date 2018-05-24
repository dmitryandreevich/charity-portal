<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 19:01
 */
?>
<form action="{{ route('profile.toggleStatus') }}" id="toggleStatus" method="post">
    {{ csrf_field() }}
    <div class="radio-row">
        <div class="radio-button">
            <input id="radio-1" name="radio" value="individual" onclick="$('#toggleStatus').submit()" type="radio" {{ $data->individual->active ? "checked" : "" }}>
            <label for="radio-1" class="radio-label">Физическое лицо</label>
        </div>
        <div class="radio-button">
            <input id="radio-2" name="radio" value="organization" onclick="$('#toggleStatus').submit()" type="radio" {{ $data->organization->active ? "checked" : ""}}>
            <label for="radio-2" class="radio-label">Организация</label>
        </div>
    </div>
</form>
