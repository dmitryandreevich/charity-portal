<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 12:57



 */
?>
<div class="bind-account">

    @if($user->vkId)
        <a href="" class="vk btn">Ваш аккаунт Вконтакте привязан!</a>
    @else
        <a href="{{ \App\Classes\VkApiHelper::getLinkAuthCode( route('profile.vkAttach') ) }}" class="vk btn">Привязать аккаунт Вконтакте</a>
    @endif
    <br>
    @if($user->fbId)
        <a href="" class="fb btn">Ваш аккаунт Facebook привязан!</a>
    @else
        <a href="{{ \App\Classes\FbApiHelper::getLinkAuthCode( route('profile.fbAttach') ) }}" class="fb btn">Привязать аккаунт Facebook</a>
    @endif
</div>