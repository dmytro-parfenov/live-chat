@foreach($messages as $message)
    <div class="message-block">
        <div class="message-blok-top">
            <div class="name">{{$message->user_name}}</div>
            <div class="time">{{$message->created_at}}</div>
        </div>
        <div class="message-block-bottom">{{$message->message}}</div>
    </div>
@endforeach