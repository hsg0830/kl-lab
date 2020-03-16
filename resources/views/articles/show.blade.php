@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1 style="color:blue">『{{ $article->title }}』</h1>
        </div>
        <div style="text-align:right">
            【{{ $article->category }}】　登録日：{{ $article->post_date }}　登録者：{{ $article->user->name }}
        </div>
        <div>
            <h4 style="color:red">課題レビュー用の補足説明</h4>
            <ul>
                <li>ログイン状態でのみ、ページ下部に【質問の投稿】フォームが表示されます。</li>
                <li>質問への回答が投稿されていない場合に限り、質問を削除するための【質問の削除】ボタンが表示されます。既に回答済みの質問は削除できません。削除権限は投稿者自身とadminに限ります。</li>
                <li>admin権限を持つユーザとしてログインした場合のみ、【質問への回答】フォームもしく投稿済みの回答を削除する【回答の削除】ボタンが表示されます。</li>
                <li>admin権限を持つユーザとしてログインした場合のみ、ページ最下部に、コラムを編集するためのeditページに飛ぶ【コラムの編集】ボタンと、コラムを削除するための【コラムの削除】ボタンが表示されます。</li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div style="background-color:gray">
                {!! $article->content !!}
        </div>

        <div style="margin-top:30px">
            <strong style="color:green">この記事に関する質問</strong>
            @if(count($article->questions) > 0)
                <ul style="margin-top:10px">
                    @foreach($article->questions as $question)
                        <li style="background-color:pink;margin-top:10px">
                            {{ $question->content }}</br>
                            質問者：{{ $question->user->name }}　投稿日：{{ $question->created_at }}</br>

                            @if(Auth::check())
                                @if(Auth::User()->id == $question->user_id | Auth::User()->is_admin == true)
                                    @if(count($question->answers)==0)
                                        {!! Form::model($question, ['route' => ['questions.destroy', $question->id], 'method' => 'delete' ]) !!}
                                          {!! Form::submit('質問の削除(質問者自身＆adminのみ)', ['class' => 'btn btn-sm btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            @endif
                        </li>

                        @if(count($question->answers)>0)

                            </br><span style="color:blue">質問への回答：</span></br>
                            <ul>
                                @foreach($question->answers as $answer)
                                    <li style="background-color:skyblue">
                                        {{$answer->content}}</br>
                                        回答者：{{ $answer->user-> name }}　回答日：{{ $answer->created_at}}</br>

                                        @if(Auth::check() && Auth::user()->is_admin == true)
                                            {!! Form::model($answer, ['route' => ['answers.destroy', $answer->id], 'method' => 'delete' ]) !!}
                                              {!! Form::submit('回答の削除(admin only)', ['class' => 'btn btn-sm btn-warning']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                        @else
                            @if(Auth::check() && Auth::user()->is_admin == true)
                                {!! Form::open(['route' => 'answers.store']) !!}
                                    <div class="form-group" style="margin-top:10px">
                                        {!! Form::label('content_A', '質問への回答') !!}
                                        {!! Form::textarea('content_A', old('content_A'), ['class' => 'form-control']) !!}
                                    </div>

                                    <input type="hidden" name="question_id" value={{$question->id}}>

                                    {!! Form::submit('回答の投稿(admin only)', ['class' => 'btn btn-sm btn-secondary']) !!}
                                {!! Form::close() !!}
                            @endif
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>

        @if(Auth::check())
            {!! Form::open(['route' => 'questions.store']) !!}
                <div class="form-group">
                    {!! Form::label('content_Q', '質問がおありの方はこちらから投稿してください。') !!}
                    {!! Form::textarea('content_Q', old('content_Q'), ['class' => 'form-control']) !!}
                </div>

                <input type="hidden" name="article_id" value="{{$article->id}}">

                {!! Form::submit('質問の投稿(User Only)', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        @else
            <p><strong>※質問を投稿したい方は{!! link_to_route('login', 'ログイン', []) !!}してください。</strong></p>
        @endif

        <div style="margin-top:20px">
            {!! link_to_route('articles.index', 'コラムのトップページ', [], ['class' => 'btn btn-success']) !!}

            @if(Auth::check() && Auth::user()->is_admin == true)
                <div class="row" style="margin-top:20px">
                    {!! link_to_route('articles.edit', 'コラムの編集(admin only)', ['id' => $article->id], ['class' => 'btn btn-info']) !!}

                    {!! Form::model($article, ['route' => ['articles.destroy', $article->id], 'method' => 'delete' ]) !!}
                        {!! Form::submit('コラムの削除(admin only)', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            @endif
        </div>

@endsection