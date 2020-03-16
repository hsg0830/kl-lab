@extends('layouts.app')

@section('content')

  <div class="center jumbotron">
    <div class="text-center">
      <h1>{{ $ask->title }}</h1>
      <p style="text-align:right">質問者：{{ $ask->user->name }}　質問日：{{ $ask->created_at }}</p>
    </div>
    <div style="margin-top:20px">
      {!! link_to_route('asks.index', '質問コーナーのトップページ', [], ['class' => 'btn btn-info']) !!}
    </div>
    <div>
      <h4 style="color:red;margin-top:20px">課題レビュー用の補足説明</h4>
        <ul>
          <li>ログイン状態でのみ、ページ下部に【回答の投稿】フォームが表示されます。</li>
          <li>質問への回答が登録されていない状態にある時に限り、【この質問の削除】ボタンが表示されます。削除権限は、質問者本人もしくはadminが有します。</li>
          <li>回答者自身もしくはadminとしてログインした場合、【回答の削除】ボタンが表示されます。</li>
        </ul>
    </div>
  </div>

  <div style="margin-top:30px">
    <h2 style="color:red">質問の内容</h2>
    <div style="background-color:pink">
      {{ $ask->ask_content }}
    </div>
    <div>
      @if(Auth::check() && count($ask->replies) == 0)
        @if(Auth::user()->id == $ask->user->id | Auth::user()->is_admin == true)
              {!! Form::model($ask, ['route' => ['asks.destroy', $ask->id], 'method' => 'delete' ]) !!}
                {!! Form::submit('質問の削除(質問者 or admin)', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
        @endif
      @endif
  </div>

  <div style="margin-top:30px">
    @if(count($ask->replies) >0)
      <h3 style="color:blue">この質問への回答</h3>

      @foreach($ask->replies as $reply)
        <div style="margin-top:15px;background-color:skyblue">
          回答者：{{ $reply->user->name }}</br>
          回答日：{{ $reply->created_at }}</br>
          回答の内容：{{ $reply->reply_content }}</br>

          @if(Auth::check())
            @if(Auth::user()->id == $reply->user->id | Auth::user()->is_admin == true)
              {!! Form::model($reply, ['route' => ['replies.destroy', $reply->id], 'method' => 'delete' ]) !!}
                {!! Form::submit('回答の削除(回答者 or admin)', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
            @endif
          @endif
        </div>
      @endforeach
    @endif
  </div>

  @if(Auth::check())
    <div style="margin-top:30px">
      <h2>質問への回答の投稿</h2>

          {!! Form::open(['route' => ['replies.store', 'ask_id' => $ask->id]]) !!}

          <table class="table">
            <tr>
              <th>{!! Form::label('reply_content', '回答の内容') !!}</th>
              <td>{!! Form::textarea('reply_content', old('reply_content')) !!}</td>
            </tr>
          </table>

            {!! Form::submit('回答の投稿', ['class' => 'btn btn-sm btn-primary']) !!}

          {!! Form::close() !!}
        </div>
      @else
        <div>
          <p><strong>※回答を投稿したい方は{!! link_to_route('login', 'ログイン', []) !!}してください。</strong></p>
        </div>
      @endif

@endsection