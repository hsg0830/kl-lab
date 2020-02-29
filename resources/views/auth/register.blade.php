@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>会員登録</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'お名前') !!}
                    {!! Form::text('name', old('name'), ['placeholder' => 'お名前を入力してください', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['placeholder' => 'メールアドレスを入力してください', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('age', '年齢') !!}
                    {!! Form::selectRange('age', 6, 110, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                        性別
                        <div class="form-check">
                            {!! Form::radio('sex', 'M', true, ['id' => 'sex01', 'class' => 'form-check-input']) !!}
                            {!! Form::label('sex01', '男性', ['class' => 'form-check-label']) !!}
                        </div>
                        
                        <div class="form-check">
                            {!! Form::radio('sex', 'F', false, ['id' =>'sex02', 'class' => 'form-check-input']) !!}
                            {!! Form::label('sex02', '女性', ['class' => 'form-check-label']) !!}
                        </div>
                </div>
                
                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['placeholder' => 'パスワードを入力してください', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワードの再確認') !!}
                    {!! Form::password('password_confirmation', ['placeholder' => '確認のためパスワードをもう一度入力してください', 'class' => 'form-control']) !!}
                </div>

                {!! Form::submit('登録', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection