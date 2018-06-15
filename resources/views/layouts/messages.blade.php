<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 17:02
 */
?>
@if( count($errors) > 0)
<div class="alert alert-danger" role="alert" onclick="this.parentElement.style.display='none';">
    @foreach ($errors->all() as $error)
        <div><strong>{{ $error }}</strong></div>
    @endforeach
</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <div><strong>{{ session('error') }}</strong></div>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <div><strong>{{ session('success') }}</strong></div>
    </div>
@endif
