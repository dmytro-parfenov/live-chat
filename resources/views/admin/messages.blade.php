@extends('admin.layout')

@section('main')

    @if (count($messages) > 0)
        <div class="col-xs-12 message-list-header">
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