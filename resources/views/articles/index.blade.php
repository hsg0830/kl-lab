@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>コラムの一覧ページ</h1>
        </div>
        <div>
            <h4 style="color:red">課題レビュー用の補足説明</h4>
            <ul>
                <li><p>admin権限を持つユーザとしてログインした場合のみ、コラムを投稿するcreateページに飛ぶための【コラムの新規投稿】ボタンが表示されます。</p></li>
            </ul>
            @if(Auth::check() && Auth::user()->is_admin == true)
                {!! link_to_route('articles.create', 'コラムの新規投稿(admin only)', [], ['class' => 'btn btn-info']) !!}
            @endif
            </p>
        </div>
    </div>


    <div>
        <table class="table table-striped">
            <tr>
                <th>カテゴリー</th>
                <th>タイトル</th>
                <th>登録日</th>
                <th>登録者</th>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->category }}</td>
                    <td>{!! link_to_route('articles.show', $article->title, ['id' => $article->id]) !!}</td>
                    <td>{{ $article->post_date }}</td>
                    <td>{{ $article->user->name }}</td>
                    </tr>
            @endforeach
        </table>

        {{ $articles->links('pagination::bootstrap-4') }}
    </div>
@endsection
