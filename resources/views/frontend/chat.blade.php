@extends('frontend.layout')

@section('main')

    <div class="messages-container content-container">
        @if (count($messages) > 0)
            <div class="show-earlier">
                {!! csrf_field() !!}
                <span data-first-message="{{$messages->first()->id}}">show earlier</span>
            </div>
            @foreach($messages as $message)
                <div class="message-block">
                    <div class="message-blok-top">
                        <div class="name">{{$message->user_name}}</div>
                        @if ($message->user_location_lat !== '' && $message->user_location_lng)
                            <div class="map-marker glyphicon glyphicon-map-marker" data-user-location-lat="{{$message->user_location_lat}}" data-user-location-lng="{{$message->user_location_lng}}"></div>
                        @endif
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

    <div class="background-map-object"></div>
    <div id="map-object">
        <div id="map-object-location"></div>
    </div>

@endsection

@push('style')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIpi0wvFb7yyxMzJZWXYxX3cEQn_byngU"></script>
<link rel="stylesheet" property='stylesheet' href="/frontend/css/chat.min.css">
@endpush

@push('script')
<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
<script type="text/javascript" src="/frontend/js/chat.min.js"></script>
@endpush