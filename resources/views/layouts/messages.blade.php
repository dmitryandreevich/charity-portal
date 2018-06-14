<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 17:02
 */
?>
@if( count($errors) > 0)
<div class="alert-error">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif
@if(session('error'))
    <div class="alert-error">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert-success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{ session('success') }}
    </div>
@endif
