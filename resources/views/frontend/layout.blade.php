<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$settings->title}}</title>
    <meta name="keywords" content="{{$settings->meta_keywords}}">
    <meta name="description" content="{{$settings->meta_description}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" property='stylesheet' href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" property='stylesheet' href="/frontend/css/layout.min.css">
    @stack('style')
</head>
<body>

    <div class="header">
        <div class="content-container">
            <div class="row">
                <div class="site-name col-xs-6"><a href="/">{{$settings->site_name}}</a><div class="users-online-counter" id="users-online-counter" data-toggle="tooltip" data-placement="bottom" title="Users online">0</div></div>
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
        @if ($settings->about !== '')
            <div class="about glyphicon glyphicon-info-sign"></div>
        @endif
    </div>

    @yield('main')

    <div class="send-message-container @if (!empty($user_name) && !empty($user_id)) send-message-container-active @endif">
        <div class="content-container">
            <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-11">
                    <textarea placeholder="Enter your message" name="message"></textarea>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-1 send-message-button">
                    <button class="glyphicon glyphicon-ok"></button>
                </div>
            </div>
        </div>
    </div>

    @if ($settings->about !== '')
        <div class="background-about-container"></div>
        <div class="about-container">
            <div class="content-text-page">{!! $settings->about !!}</div>
        </div>
    @endif

    <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/bower_components/device.js/lib/device.min.js"></script>
    <script type="text/javascript" src="/bower_components/online-visitors-counter-master/ovc/counter.js"></script>
    <script type="text/javascript" src="/frontend/js/layout.min.js"></script>
    @stack('script')

</body>
</html>