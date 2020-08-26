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
                <form class="search" method="POST" action="{{ route('chat', ['user_id' => Auth::user()->id])}}">
                    @csrf
                    <label for=""></label>
                    <input type="tel" name="search_contact" placeholder="Search contacts..." />
                    <button class="btn btn_search" type="submit"><i class="fa fa-search"
                            aria-hidden="true"></i>Search</button>
                </form>
            </div>
            <div id="contacts">
                @if($search_contact)
                <ul>
                    <h4>Результат поиска:</h4>
                    @foreach($search_contact as $contact)

                    <li class="contact">
                        <div class="wrap">
                            <a href="{{ route('chat.user', ['friend_id' => "$contact->id"]) }}">
                                <span class="contact-status online"></span>
                                <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
                                <div class="meta">
                                    <p class="name">{{ $contact->name }}</p>
                                    <p class="preview">You just got LITT up, Mike.</p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <hr style="background-color:white">
                    @endforeach
                </ul>
                @endif
                <ul>
                    <h4>Ваши контакты:</h4>
                    <!-- All friends -->
                    @if(!$contacts->count())
                    <p>У вас нет чатов!</p>
                    @else
                    <?php $friend_id = ''; ?>
                    @foreach($contacts as $contact)
                    <?php $friend_id = $contact->id; ?>
                    <li class="contact">
                        <div class="wrap">
                            <?php $friend_id = ''; ?>
                            <?php $friend_id = $contact->id; ?>
                            <a href="{{ route('chat.user', ['friend_id' => "$contact->id"])}}">
                                <span class="contact-status online"></span>
                                <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
                                <div class="meta">
                                    <p class="name">{{ $contact->name }}</p>
                                    <p class="preview">You just got LITT up, Mike.</p>
                                </div>
                            </a>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div id="bottom-bar">
                <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add
                        contact</span></button>
                <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
            </div>
        </div>
        <div class="content">
            @yield('chat')
            <!-- <div class="messages"> -->
            <h3>Выберите чат</h3>
            <!-- </div> -->
        </div>
    </div>
    <script src='{{ asset("../resources/js/script.js") }}'></script>
</body>

</html>