@extends('admin.layout')

@section('main')

    @if(Session::has('success'))
        <div class="alert alert-success col-xs-12" role="alert">{{ Session::get('success') }}</div>
    @endif

    @include('errors.form-errors')

    <form method="get" action="" class="messages-sort-form col-xs-12">
        <div class="row">
            <div class="col-xs-12 col-sm-2">
                <label>Search</label>
                <input type="search" name="search_value" value="{{Input::get('search_value')}}" class="form-control" placeholder="Enter message text">
            </div>
            @if (count($users_list) > 0)
                <div class="col-xs-12 col-sm-2">
                    <label>User</label>
                    <select class="form-control user-select" name="user_value">
                        <option value="0" @if (Input::get('user_value') === 0) selected="" @endif>Change user</option>
                        @foreach($users_list as $user_list)
                            <option value="{{$user_list->user_name}}" @if (Input::get('user_value') === $user_list->user_name) selected="" @endif>{{$user_list->user_name}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="col-xs-12 col-sm-2">
                <label>Date</label>
                <input type="date" name="filter_date" value="{{Input::get('filter_date')}}" class="form-control">
            </div>
            <div class="col-xs-12 col-sm-2">
                <label>Order by</label>
                <select class="form-control order-by-select" name="order_by_value">
                    <option value="0" @if (Input::get('order_by_value') == 0) selected="" @endif>Newest</option>
                    <option value="1" @if (Input::get('order_by_value') == 1) selected="" @endif>Oldest</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-1">
                <a href="/master/messages" title="Reset filter"><i class="glyphicon glyphicon-repeat reset-filter"></i></a>
            </div>
        </div>
    </form>

    @if (count($messages) > 0)
        <div class="col-xs-12 message-list-header hidden-xs">
            <div class="row">
                <div class="col-xs-12 col-sm-3">User</div>
                <div class="col-xs-12 col-sm-7">Message</div>
                <div class="col-xs-12 col-sm-2">Control</div>
            </div>
        </div>
        <form class="col-xs-12 messages-control-form" method="POST" action="/master/messages">
            {!! csrf_field() !!}
            <div class="row">
                @foreach($messages as $message)
                    <div class="col-xs-12 message-list-block">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3">{{$message->user_name}}<span>{{$message->created_at}}</span></div>
                            <div class="col-xs-12 col-sm-7">{{$message->message}}</div>
                            <div class="col-xs-12 col-sm-2">
                                <input type="checkbox" name="messages_check[]" value="{{$message->id}}" class="checkbox-message">
                                <button class="form-control btn-default delete-message">Delete</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
        <div class="col-xs-12">
            <button class="form-control btn-danger delete-all-messages">Delete all</button>
        </div>
    @else
        <div class="col-xs-12">No messages</div>
    @endif

@endsection

@push('style')
<link rel="stylesheet" property='stylesheet' href="/admin/css/messages.min.css">
@endpush

@push('script')
<script type="text/javascript" src="/admin/js/messages.min.js"></script>
@endpush