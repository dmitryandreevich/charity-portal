@extends('layouts.app')
@section('page-title', 'Авторизуйтесь в системе')
@section('custom-script')
    <script>
        $(document).ready(function () {
            $('a[data-modal="#modal6"]').trigger('click');
        });
    </script>
@endsection
