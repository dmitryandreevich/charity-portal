<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 17:02
 */
?>
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach

    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
