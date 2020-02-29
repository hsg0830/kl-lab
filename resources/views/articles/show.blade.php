@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1 style="color:blue">『{{ $article -> title }}』</h1>
        </div>
        <div style="text-align:right">
            【{{ $article->category }}】　登録日：{{ $article->post_date }}　登録者：{{ $article->user_id }}
        </div>
    </div>

    <div class="container">
        <div>
            <div class="col-sm-8 offset-sm-2">
                {!! $article->content !!}
            </div>
        </div>

        <div style="margin-top:10px">
            <div class="col-sm-8 offset-sm-2">
                <div class="row">
                    {!! link_to_route('articles.index', 'コラムのトップページ', [], ['class' => 'btn btn-success']) !!}
                </div>

                @if(Auth::check() && Auth::user()->is_admin == true)
                    <div class="row" style="margin-top:10px">
                        {!! link_to_route('articles.edit', 'コラムの編集', ['id' => $article->id], ['class' => 'btn btn-success']) !!}

                        {!! Form::model($article, ['route' => ['articles.destroy', $article->id], 'method' => 'delete' ]) !!}
                          {!! Form::submit('コラムの削除', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection