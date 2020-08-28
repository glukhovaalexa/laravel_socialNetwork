@extends('profile')
@section('chat')
<div class="contact-profile">
    @if($friends)
    <?php $friend_name = '' ?>
    @foreach($friends as $friend)
    <img src="{{ (!$friend->photo) ? asset('photo/no-avatar.jpg') : $friend->photo }}" alt="" />
    <?php $friend_name = $friend->name ?>
    @endforeach
    <p class="name">{{ $friend_name}}</p>
    @endif

    @if($posibleFriend)
    <?php $posible_name = '' ?>
    @foreach($posibleFriend as $posible)
    <?php $posible_name = $posible->name ?>
    @endforeach
    <img src="{{ (!isset($posible->photo)) ? asset('photo/no-avatar.jpg') : $posible->photo }}" alt="" />
    <p class="name">{{ $posible_name}}</p>
    @endif
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
                    <img src="{{ (isset($messages)) ? asset('photo/no-avatar.jpg') : $message->photo }}" alt="" />
                </div>
                <p>
                    {{ (($message->user_id === Auth::user()->id) === '') ? $message->friend_name : $message->user_name }}
                </p>
            </div>
            <div class="msg_info">
                <p class="msg">{{ $message->message}}</p>
                <p class="msg_created">{{ $message->created_at}}</p>
            </div>
        </li>
        @endforeach
    </ul>
    @else
    <p>У вас еще нет сообщений!</p>
    @endif
    <div class="message-input">
        <div class="wrap">
            @if($posibleFriend)
                @foreach($posibleFriend as $posible)
                    <?php $friend_id = (($posibleFriend) ? $posible->id : $friend_id) ?>
                @endforeach
            @endif
            <form action="{{ route('chat.sendMsg', ['friend_id' => $friend_id]) }}" method="POST">
                @csrf
                <input name="message" type="text" placeholder="Write your message..." v-model="messageBox" />
                <input name="user_id" type="hidden" value="{{Auth::user()->id}}" />
                @if($posibleFriend)
                @foreach($posibleFriend as $posible)
                <input name="friend_id" type="hidden" value="{{$posible->id}}" />
                @endforeach
                @else
                @foreach($friends as $friend)
                <input name="friend_id" type="hidden" value="{{$friend->id}}" />
                @endforeach
                @endif
                <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>

    @endsection