@extends('layouts.app')

@section('main-block')

    <div class="main-block new-org">
        @include('profile.consumer.topMenu')
        <div class="new-org_content">
            <div class="container">
                <h2 class="title">Новая Организация</h2>
                <form class="new-org__form" method="post" action="{{ route('organizations.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="list w50">
                        <select placeholder="Тип потребителя" name="type_consumer" class="headroom_city sources custom-select">
                            @foreach(\App\Classes\TypesOfOrganizations::typesOrganizations as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <select placeholder="Выберите город" name="city" class="headroom_city sources custom-select">
                            <option value="Омск">Омск</option>
                            <option value="Москва">Москва</option>
                            <option value="Питер">Питер</option>
                        </select>
                    </div>
                    <div class="list">
                        <input type="text" placeholder="Адрес организации" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="list">
                        <input type="text" placeholder="Название организации" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="list">
                        <textarea placeholder="Описание организации" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="add-file">
                        <div class="file-upload">
                            <label>
                                <input type="file" name="cover" value="{{ old('cover') }}"><span>Загрузить обложку</span>
                            </label>
                        </div>
                        <div class="file-upload">
                            <label>
                                <input type="file" multiple name="photos[]" value="{{ old('photos[]') }}"><span>Загрузить фотографии</span>
                            </label>
                        </div>
                        <div class="file-upload">
                            <label>
                                <input type="file" name="docs" value="{{ old('docs') }}"><span>Загрузить документы для прохождения модерации</span>
                            </label>
                        </div>
                    </div>
                    <div class="btn-block">
                        <button class="btn" type="submit" name="preview" formtarget="_blank">Предварительный просмотр</button>
                        <input type="submit" value="Отправить на модерацию" name="send">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection