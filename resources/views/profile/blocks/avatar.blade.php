<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 18:31
 */
?>

<a  href="#" data-modal="#modalChangeAvatar" class="link open-modal">
    @if(\Illuminate\Support\Facades\Auth::user()->avatar == "")
        <img src="{{ asset("img/dummy200.png") }}">
    @else
        <img src="{{ asset("storage/"  . \Illuminate\Support\Facades\Auth::user()->avatar) }}">
    @endif
</a>