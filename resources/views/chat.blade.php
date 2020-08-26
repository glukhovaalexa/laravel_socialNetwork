@extends('profile')
@section('chat')
<div class="contact-profile">
    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />

    @foreach($friends as $friend)
    <p class="name">{{ $friend->name}}</p>

    </a>
    @endforeach
    <div class="social-media">
        <i class="fa fa-facebook" aria-hidden="true"></i>
        <i class="fa fa-twitter" aria-hidden="true"></i>
        <i class="fa fa-instagram" aria-hidden="true"></i>
    </div>
</div>
<div class="messages">
@if($messages->count())
    <ul>
        @foreach($messages as $message)
        <li class="{{ ($message->user_id === Auth::user()->id) ? 'replies' : 'sent'}}">
            <div class="contact_wrap">
                <div class="img_chat_mini">
                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                </div>
                <p>
                    {{ (($message->user_id === Auth::user()->id) === '') ? $message->friend_name : $message->user_name }}
                </p>
            </div>
            <div class="msg_info">
        </li>
        @endforeach
    </ul>
@else
<p>У вас еще нет сообщений!</p>
@endif
<div class="message-input">
    <div class="wrap">
        <form action="{{ route('chat.sendMsg', ['friend_id' => $friend_id]) }}" method="POST">
            @csrf
            <input name="message" type="text" placeholder="Write your message..." v-model="messageBox" />
            <input name="user_id" type="hidden" value="{{Auth::user()->id}}" />
            @foreach($friends as $friend)
            <input name="friend_id" type="hidden" value="{{$friend->id}}" />
            @endforeach
            <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
            <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </form>
    </div>
</div>

@endsection