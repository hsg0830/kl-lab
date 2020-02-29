@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="center jumbotron">
            <div class="text-center">
                <img class="logo" src="{{ asset('img/main.jpg') }}" alt="メイン画像">
            </div>
        </dib>
    </div>

    <div class="row">
        <div class="col text-center">
            {!! link_to_route('articles.index', 'コラム', [], ['class' => 'btn btn-success']) !!}
        </div>
        <div class="col text-center">
            資料室
        </div>
        <div class="col text-center">
            質問コーナー
        </div>
    </div>
@endsection