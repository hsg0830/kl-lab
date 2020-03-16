@extends('layouts.app')

@section('content')

  <div class="center jumbotron">
    <div class="text-center">
      <h1>資料の詳細：<span style="color:blue">{{ $resource->title }}</span></h1>
    </div>
    <div>
      <h4 style="color:red">課題レビュー用の補足説明</h4>
        <ul>
          <li>ログイン状態でのみ、ファイルのダウンロードが可能です。ダウンロードは、タイトルのリンク、もしくは下部の【ダウンロード】ボタンをクリックすると実行されます。</li>
          <li>登録者本人もしくはadminとしてログインした場合、下部に【ファイルの削除】ボタンが表示されます。</li>
        </ul>
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

  @if(Auth::check())

    <div class="container">
      <div class="row">
        <div class="col">
          {!! link_to_route('download', 'このファイルをダウンロード', ['id' => $resource->id], ['class' => 'btn btn-sm btn-success']) !!}
        </div>

        <div class="col">
          @if(Auth::User()->id == $resource->user->id | Auth::User()->is_admin == true)
            {!! Form::model($resource, ['route' => ['resources.destroy', $resource->id], 'method' => 'delete' ]) !!}
              {!! Form::submit('ファイルの削除(登録者本人 or admin)', ['class' => 'btn btn-sm btn-danger']) !!}
            {!! Form::close() !!}
          @endif
        </div>
      </div>
    </div>
  @else
    <div>
      <p><strong>※この資料をダウンロードしたい方は{!! link_to_route('login', 'ログイン', []) !!}してください。</strong></p>
    </div>
  @endif

@endsection