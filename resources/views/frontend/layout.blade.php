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
                <div class="site-name col-xs-6">Live chat</div>
                @if (!empty($user_name) && !empty($user_id))
                    <div class="user-name col-xs-6"><span data-toggle="tooltip" data-placement="bottom" title="Edit name">{{$user_name}}</span></div>
                @endif
                <form class="get-user-name col-xs-6 @if (empty($user_name) || empty($user_id)) get-user-name-active @endif" method="POST" action="/send-user-name">
                    {!! csrf_field() !!}
                    <input type="text" placeholder="Enter your name for chatting" name="user_name" maxlength="10">
                </form>
            </div>
        </div>
    </div>

    @yield('main')

    <div class="send-message-container @if (!empty($user_name) && !empty($user_id)) send-message-container-active @endif">
        <div class="content-container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-10">
                    <input type="text" placeholder="Enter your message" name="message" autocomplete="off" data-token="{{ csrf_token() }}">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2">
                    <button>send</button>
                </div>
            </div>
        </div>
    </div>

    <div class="notification"></div>

    <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/frontend/js/layout.min.js"></script>
    @stack('script')

</body>
</html>