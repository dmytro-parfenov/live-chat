@extends('admin.layout')

@section('main')

    @if(Session::has('success'))
        <div class="alert alert-success col-xs-12" role="alert">{{ Session::get('success') }}</div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
    @endif

    @include('errors.form-errors')

    @if ($auth_user->permission === 'admin')
        <div class="col-xs-12 col-sm-2">
            <a href="/master/users/add" class="btn-primary form-control">Add user</a>
        </div>
    @endif

    <div class="col-xs-12 users-list-header hidden-xs">
        <div class="row">
            <div class="col-xs-12 col-sm-3">Name</div>
            <div class="col-xs-12 col-sm-3">E-mail</div>
            <div class="col-xs-12 col-sm-3">Permission</div>
            <div class="col-xs-12 col-sm-2">Control</div>
        </div>
    </div>

    <form class="col-xs-12 users-list-form" method="POST" action="/master/users">
        {!! csrf_field() !!}
        @foreach($users as $user)
            <div class="users-list-form-block">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">{{$user->name}}@if ($auth_user->email === $user->email)<div class="current-user"></div>@endif</div>
                    <div class="col-xs-12 col-sm-3"><a href="mailto:{{$user->email}}">{{$user->email}}</a></div>
                    <div class="col-xs-12 col-sm-3">{{$user->permission}}</div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="row">
                            @if ($auth_user->permission === 'admin')
                                <div class="col-xs-6">
                                    <a href="/master/users/edit/{{$user->id}}" class="btn btn-success">Edit</a>
                                </div>
                            @else
                                @if ($auth_user->email === $user->email)
                                    <div class="col-xs-6">
                                        <a href="/master/users/edit/{{$user->id}}" class="btn btn-success">Edit</a>
                                    </div>
                                @endif
                            @endif
                            @if ($user->permission !== 'admin' && $auth_user->permission === 'admin')
                                <div class="col-xs-6">
                                    <input type="checkbox" name="user_check" value="{{$user->id}}" class="user-check">
                                    <button class="btn-danger form-control user-delete">Delete</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </form>

@endsection

@push('style')
<link rel="stylesheet" property='stylesheet' href="/admin/css/show-users.min.css">
@endpush

@push('script')
<script type="text/javascript" src="/admin/js/show-users.min.js"></script>
@endpush