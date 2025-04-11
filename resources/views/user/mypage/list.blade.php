<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>マイページ</title>
    </head>
    <body>
        <h1>{{ $user->name }}さんのページ</h1>

        <ul class="header_ul">
            <li class="header_link"><a class="link_text" href="{{ route('user.mypage.edit') }}">プロフィール編集</a></li>
            <li class="header_link"><a class="link_text" href="{{ route('user.user_order.list') }}">購入履歴</a></li>
            <li class="header_link"><a class="link_text" href="{{ route('user.favorites.list') }}">お気に入り商品一覧</a></li>
        </ul>
        <div class="sns_section">
            <h3 class="sns_title">SNS連携</h3>
            <div class="sns_buttons">
                <a href="{{ route('user.auth.redirect', ['provider' => 'google']) }}" class="sns-button google"><i class="fab fa-google"></i>Googleと連携</a>
                <a href="{{ route('user.auth.redirect', ['provider' => 'facebook']) }}" class="sns-button facebook"><i class="fab fa-facebook"></i>Facebookと連携</a>
                <a href="{{ route('user.auth.redirect', ['provider' => 'twitter']) }}" class="sns-button twitter"><i class="fab fa-twitter"></i>Twitterと連携</a>
            </div>
        </div>
        <a href="{{ route('user.top')}}">トップへ戻る</a>
    </body>
</html>

