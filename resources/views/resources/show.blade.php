@extends('layouts.app')

@section('content')

  <div class="center jumbotron">
    <div class="text-center">
      <h1>{{ $resource->title }}</h1>
    </div>
  </div>

  {!! link_to_route('resources.index', '資料室のトップへ', [], ['class' => 'btn btn-info']) !!}

  <div>
    <table class="table" style="margin-top:40px">
      <tr>
        <th>カテゴリー</th>
        <td>{{ $resource->category }}</td>
      </tr>
      <tr>
        <th>ファイルのタイトル</th>
        <td>{!! link_to_route('download', $resource->title, ['id' => $resource->id]) !!}</td>
      </tr>
      <tr>
        <th>登録者</th>
        <td>{{ $resource->user->name }}</td>
      </tr>
      <tr>
        <th>登録日</th>
        <td>{{ $resource->created_at }}</td>
      </tr>
      <tr>
        <th>ファイルの種類</th>
        <td>{{ $resource->type_of_file }}</td>
      </tr>
    </table>
  </div>

  <div style="background-color:pink">
    <strong style="color:green">このファイルに関する説明</strong>
    <p style="margin:20px">
      {{ $resource->explanation }}
    </p>
  </div>

  @if(Auth::check() && Auth::User()->is_admin == true)
    {!! Form::model($resource, ['route' => ['resources.destroy', $resource->id], 'method' => 'delete' ]) !!}
      {!! Form::submit('ファイルの削除(adminのみ)', ['class' => 'btn btn-sm btn-danger']) !!}
    {!! Form::close() !!}
  @endif

@endsection