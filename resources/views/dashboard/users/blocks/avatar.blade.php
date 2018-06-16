<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 18:31
 */
?>
<a  href="#" class="link open-modal">

    @if($user->avatar == "")
        <img src="{{ asset("img/dummy200.png") }}">
    @else
        <img src="{{ asset("storage/"  . $user->avatar) }}">
    @endif
</a>