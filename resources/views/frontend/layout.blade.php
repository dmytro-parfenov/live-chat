<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live chat</title>
    <meta name="keywords" content="live, chat, laravel">
    <meta name="description" content="Live chat">
    <link rel="stylesheet" property='stylesheet' href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" property='stylesheet' href="/frontend/css/layout.min.css">
    @stack('style')
</head>
<body>

    <div class="header">
        <div class="content-container">
            <div class="row">
                <div class="site-name col-xs-6"><a href="/">Live chat</a>{{--<div class="users-online-counter" data-toggle="tooltip" data-placement="bottom" title="Users online">1</div>--}}</div>
                @if (!empty($user_name) && !empty($user_id))
                    <div class="user-name col-xs-6"><span>{{$user_name}}</span></div>
                @endif
                <form class="get-user-name col-xs-6 @if (empty($user_name) || empty($user_id)) get-user-name-active @endif" method="POST" action="/send-user-name">
                    {!! csrf_field() !!}
                    <input type="text" placeholder="Enter your name" name="user_name" maxlength="10" autocomplete="off" required>
                </form>
            </div>
        </div>
        <form class="search-form col-xs-12" action="" method="GET">
            <div><input type="search" placeholder="Search" name="search_value" autocomplete="off" required></div>
        </form>
    </div>

    <div class="tool-pannel">
        <div class="search glyphicon glyphicon-search"></div>
        <div class="arrow-up glyphicon glyphicon-arrow-up"></div>
        <div class="arrow-down glyphicon glyphicon-arrow-down"></div>
    </div>

    @yield('main')

    <div class="send-message-container @if (!empty($user_name) && !empty($user_id)) send-message-container-active @endif">
        <div class="content-container">
            <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-11">
                    <input type="text" placeholder="Enter your message" name="message" autocomplete="off" data-token="{{ csrf_token() }}">
                </div>
                <div class="col-xs-3 col-sm-2 col-md-1 send-message-button">
                    <button class="glyphicon glyphicon-ok"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="geolocation-token">{!! csrf_field() !!}</div>

    <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/frontend/js/layout.min.js"></script>
    @stack('script')

</body>
</html>