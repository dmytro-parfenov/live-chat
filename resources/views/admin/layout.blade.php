<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" property='stylesheet' href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" property='stylesheet' href="/admin/css/layout.min.css">
    @stack('style')
</head>
<body>

    <ul class="nav nav-tabs">
        <li role="presentation" @if( in_array( Request::segment(2), ['settings'] ) ) class="active" @endif><a href="/master/settings">Settings</a></li>
        <li role="presentation" @if( in_array( Request::segment(2), ['messages'] ) ) class="active" @endif><a href="/master/messages">Messages</a></li>
        <li role="presentation" @if( in_array( Request::segment(2), ['users'] ) ) class="active" @endif><a href="/master/users">Master settings</a></li>
    </ul>

    <div class="content-container">
        @yield('main')
    </div>

    <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/admin/js/layout.min.js"></script>
    @stack('script')

</body>
</html>