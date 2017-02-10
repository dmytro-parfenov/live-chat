@foreach($messages as $mes)
    <div class="message-block">
        <div class="message-blok-top">
            <div class="name">{{$mes->user_name}}</div>
            <div class="time">{{$mes->created_at}}</div>
        </div>
        <div class="message-block-bottom">{{$mes->message}}</div>
    </div>
@endforeach