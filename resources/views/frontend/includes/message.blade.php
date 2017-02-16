@if (isset($messages))
    @foreach($messages as $mes)
        <div class="message-block">
            <div class="message-blok-top">
                <div class="name">{{$mes->user_name}}</div>
                @if ($mes->user_location_lat !== '' && $mes->user_location_lng)
                    <div class="map-marker glyphicon glyphicon-map-marker" data-user-location-lat="{{$mes->user_location_lat}}" data-user-location-lng="{{$mes->user_location_lng}}"></div>
                @endif
                <div class="time">{{$mes->created_at}}</div>
            </div>
            <div class="message-block-bottom">{{$mes->message}}</div>
        </div>
    @endforeach
@elseif (isset($message))
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
@endif
