@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>質問コーナーのトップページ</h1>
        </div>
    </div>

    <div>
      <h2>最近の質問</h2>
      <table class="table table-striped">
        <tr>
          <th>カテゴリー</th>
          <th>タイトル</th>
          <th>質問者</th>
          <th>質問日</th>
          <th>回答の数</th>
        </tr>
        @foreach($asks as $ask)
          <tr>
            <td>{{ $ask->category }}</td>
            <td>{!! link_to_route('asks.show', $ask->title, ['id' => $ask->id]) !!}</td>
            <td>{{ $ask->user->name }}</td>
            <td>{{ $ask->created_at }}</td>
            <td>##</td>
          </tr>
        @endforeach
      </table>
    </div>

    @if(Auth::check())
      <div style="margin-top:30px">
        <h2>質問の投稿</h2>

            {!! Form::open(['route' => 'asks.store']) !!}

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
                <th>{!! Form::label('title', '質問のタイトル') !!}</th>
                <td>{!! Form::text('title', old('title')) !!}</td>
              </tr>
              <tr>
                <th>{!! Form::label('ask_content', '質問の内容') !!}</th>
                <td>{!! Form::textarea('ask_content', old('ask_content')) !!}</td>
              </tr>
            </table>

              {!! Form::submit('質問の投稿', ['class' => 'btn btn-sm btn-primary']) !!}

            {!! Form::close() !!}
        </div>
      @endif

@endsection