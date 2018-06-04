<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 04.06.2018
 * Time: 19:08
 */?>
<table width="100%">
    <tr>
        <th>Id потребности</th>
        <th>Id организации</th>
        <th>Тип потребности</th>
        <th>Статус</th>
        <th colspan="2">Операции</th>
    </tr>
    @foreach($needs as $need)
        <tr>
            <td>{{ $need->id }}</td>
            <td>{{ $need->id_org }}</td>
            <td>{{ \App\Classes\TypeOfNeed::NAMES[$need->type_need] }}</td>
            <td>{{ \App\Classes\StatusOfNeed::NAMES[$need->status] }}</td>
            @if($need->status == \App\Classes\StatusOfNeed::STATUS_BLOCK)
                <td><a href="{{ route('dashboard.moderation.need.unblock', ['need' => $need->id]) }}" style="color: black">Разблокировать</a></td>
            @else
                <td><a href="{{ route('dashboard.moderation.need.block', ['need' => $need->id]) }}" style="color: black">Заблокировать</a></td>
            @endif

            <td><a href="{{ route('organizations.show', ['organization' => $need->id_org]) }}" style="color: black">Перейти</a></td>
        </tr>
    @endforeach
</table>
