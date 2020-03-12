@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="center jumbotron">
            <div class="text-center">
                <h1>制作中：KLラボのトップページ</h1>
                <!-- <img class="logo" src="{{ asset('img/main.jpg') }}" alt="メイン画像"> -->
            </div>
        </dib>
    </div>

    <div class="row">
        <div class="col text-center">
            {!! link_to_route('articles.index', 'コラム', [], ['class' => 'btn btn-success']) !!}

            <p style="margin-top:20px"><h3 style="color:green">最近のコラム</h3></p>
            <table class="table table-striped" style="margin-top:20px">
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->category }}</td>
                        <td>{!! link_to_route('articles.show', $article->title, ['id' => $article->id]) !!}</td>
                        <td>{{ $article->post_date }}</td>
                    </tr>
                @endforeach
            </table>

        </div>

        <div class="col text-center">
            {!! link_to_route('resources.index', '資料室', [], ['class' => 'btn btn-info']) !!}

            <p style="margin-top:20px"><h3 style="color:green">最近の資料</h3></p>
            <table class="table table-striped" style="margin-top:20px">
                @foreach($resources as $resource)
                    <tr>
                        <td>{{ $resource->category }}</td>
                        <td>{!! link_to_route('resources.show', $resource->title, ['id' => $resource->id]) !!}</td>
                        <td>{{ $resource->type_of_file }}</td>
                        <td>{{ $resource->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="col text-center">
            {!! link_to_route('asks.index', '質問コーナー', [], ['class' => 'btn btn-warning']) !!}

            <p style="margin-top:20px"><h3 style="color:green">最近の質問</h3></p>
            <table class="table table-striped" style="margin-top:20px">
                @foreach($asks as $ask)
                    <tr>
                        <td>{{ $ask->category }}</td>
                        <td>{!! link_to_route('asks.show', $ask->title, ['id' => $ask->id]) !!}</td>
                        <td>{{ $ask->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection