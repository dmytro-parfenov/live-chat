@extends('frontend.layout')

@section('main')

    <div class="messages-container content-container">
        @if (count($messages) > 0)
            @foreach($messages as $message)
                <div class="message-block">
                    <div class="message-blok-top">
                        <div class="name">{{$message->user_name}}</div>
                        <div class="time">{{$message->created_at}}</div>
                    </div>
                    <div class="message-block-bottom">{{$message->message}}</div>
                </div>
            @endforeach
        @else
            <div class="message-block">
                <div class="no-messages">no messages</div>
            </div>
        @endif
    </div>


@endsection

@push('style')
<link rel="stylesheet" property='stylesheet' href="/frontend/css/chat.min.css">
@endpush

@push('script')
<script type="text/javascript" src="/frontend/js/chat.min.js"></script>
@endpush