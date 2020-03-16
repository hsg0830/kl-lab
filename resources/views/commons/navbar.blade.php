<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">KLラボ</a>

        <div style="color:yellow">
            @if (Auth::check())
                {{ Auth::user()->name }}さん
            @endif
        </div>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{{ HTML::mailto('admin@gmail.com', 'お問い合わせ', array('class' => 'nav-link')) }}</li>
                @else
                    <li class="nav-item">{!! link_to_route('signup.get', '会員登録', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{{ HTML::mailto('admin@gmail.com', 'お問い合わせ', array('class' => 'nav-link')) }}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>