<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
        rel="stylesheet">
    <title>Welcome</title>


</head>

<body>
    <div id="frame">

        <div id="sidepanel">
            <div id="profile">
                <div class="wrap">
                    <img id="profile-img" src="http://emilcarlsson.se/assets/mikeross.png" class="online" alt="" />
                    <p>{{ Auth::user()->name}}</p>
                    <p>{{ Auth::user()->message}}</p>
                    <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                    <div id="status-options">
                        <ul>
                            <li id="status-online" class="active"><span class="status-circle"></span>
                                <p>Online</p>
                            </li>
                            <li id="status-offline"><span class="status-circle"></span>
                                <p>Offline</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="search">
                <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                <input type="text" placeholder="Search contacts..." />
            </div>
            <div id="contacts">
                <ul>
                    <!-- All friends -->
                    <li class="contact">
                        <div class="wrap">
                            @if(!$contacts->count())
                            <p>У вас нет чатов!</p>
                            @else
                            @foreach($contacts as $contact)
                            <a href="{{ route('chat.user', ['friend_id' => "$contact->id"]) }}">
                                <span class="contact-status online"></span>
                                <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
                                <div class="meta">
                                    <p class="name">{{ $contact->name }}</p>
                                    <p class="preview">You just got LITT up, Mike.</p>
                                </div>
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
            <div id="bottom-bar">
                <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add
                        contact</span></button>
                <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
            </div>
        </div>
        <div class="content">
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
                            <p class="msg">{{ $message->message}}</p>
                            <p class="msg_created">{{ $message->created_at}}</p>
                        </div>


                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="message-input">
                <div class="wrap">
                    <input type="text" placeholder="Write your message..." />
                    <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>