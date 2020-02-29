@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>コラムの新規投稿ページ</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 offset-sm-2">

            {!! Form::open(['route' => 'articles.store']) !!}
                <div class="form-group">
                    {!! Form::label('category', 'カテゴリー') !!}
                    {!! Form::select('category', [
                        '語彙' => '語彙',
                        '文法' =>'文法',
                        '学習法' => '学習法',
                        '辞書・教材' => '辞書・教材',
                    ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('post_date', '投稿日') !!}
                    {!! Form::date('post_date', old('post_date'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('title', 'タイトル') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('content', '本文') !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
                </div>

                <input type="hidden" name="user_id" value="{{Auth::User()->id}}">

                {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection