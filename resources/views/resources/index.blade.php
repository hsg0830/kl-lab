@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>資料室のトップページ</h1>
        </div>
        <div>
            <h4 style="color:red">課題レビュー用の補足説明</h4>
            <ul>
                <li>ログイン状態でのみ、ページ下部に【資料をアップロード】するためのフォームと、【資料をリクエスト】するためのフォームが表示されます。</li>
                <li>リクエストに関しては、投稿者自身もしくはadminとしてログインした場合のみ、【リクエストの削除】ボタンが表示されます。</li>
            </ul>
        </div>
    </div>

    <div>
      <h2>最近の資料</h2>
      <table class="table table-striped">
        <tr>
          <th>カテゴリー</th>
          <th>タイトル</th>
          <th>登録日</th>
          <th>登録者</th>
          <th>ファイルの種類</th>
        </tr>
        @foreach($resources as $resource)
          <tr>
            <td>{{ $resource->category }}</td>
            <td>{!! link_to_route('resources.show', $resource->title, ['id' => $resource->id]) !!}</td>
            <td>{{ $resource->created_at }}</td>
            <td>{{ $resource->user->name }}</td>
            <td>{{ $resource->type_of_file }}</td>
          </tr>
        @endforeach
      </table>

        {{ $resources->links('pagination::bootstrap-4') }}
    </div>

    <div style="margin-top:30px">
      <h2>リクエストが届いている資料</h2>
      <table class="table">
        <tr>
          <th>リクエストの詳細</th>
          <th>投稿者</th>
          <th>投稿日</th>
          <th></th>
        </tr>
        @foreach($offers as $offer)
          <tr>
            <td>{{ $offer->offer_content }}</td>
            <td>{{ $offer->user->name }}</td>
            <td>{{ $offer->created_at }}</td>
            <td>
              @if(Auth::check())
                @if(Auth::User()->id == $offer->user->id | Auth::User()->is_admin == true)
                  {!! Form::model($offer, ['route' => ['offers.destroy', $offer->id], 'method' => 'delete' ]) !!}
                    {!! Form::submit('リクエストの削除(本人 or adminのみ)', ['class' => 'btn btn-sm btn-danger']) !!}
                  {!! Form::close() !!}
                @endif
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>

    @if(Auth::check())
      <div class="container" style="margin-top:30px">
        <div class="row">
          <div class="col-sm-6" style="background-color:skyblue">
            <h2>資料のアップロード</h2>

            {!! Form::open(['route' => 'resources.store', 'files' => true]) !!}

            <table class="table">
              <tr>
                <th>{!! Form::label('category', 'カテゴリー') !!}</th>
                <td>
                  {!! Form::select('category', [
                      '語彙' => '語彙',
                      '文法' =>'文法',
                      '学習法' => '学習法',
                      '辞書・教材' => '辞書・教材',
                    ]) !!}
                </td>
              </tr>
              <tr>
                <th>{!! Form::label('title', '資料のタイトル') !!}</th>
                <td>{!! Form::text('title', old('title')) !!}</td>
              </tr>
              <tr>
                <th>{!! Form::label('explanation', '資料の説明') !!}</th>
                <td>{!! Form::textarea('explanation', old('explantion')) !!}</td>
              </tr>
              <tr>
                <th>ファイルの選択</th>
                <td>{{ Form::file('file') }}</td>
              </tr>
            </table>

              {!! Form::submit('資料のアップロード', ['class' => 'btn btn-sm btn-primary']) !!}

            {!! Form::close() !!}
        </div>

        <div class="col-sm-6" style="background-color:pink">
          <h2>資料のリクエスト</h2>

          {!! Form::open(['route' => 'offers.store', 'files' => true]) !!}

            <div class="form-group">
              {!! Form::label('offer_content', '欲しい資料の詳細') !!}
              {!! Form::textarea('offer_content', old('offer_content'), ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('リクエストの登録', ['class' => 'btn btn-sm btn-info']) !!}
          {!! Form::close() !!}

        </div>

    </div>
    @endif

<!-- <a href="/storage/アップロードのテストファイル.txt">アップロードファイル</a> -->

@endsection