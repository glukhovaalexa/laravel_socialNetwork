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
                    <div>
                        <a href="{{ route('profile.settings', ['user_id' => Auth::user()->id]) }}">
                            <img id="profile-img"
                                src="{{ (!Auth::user()->avatar_path) ? asset('photo/no-avatar.jpg') :   asset(Auth::user()->avatar_path) }}"
                                class="{{ (!Auth::check()) ? 'offline' : 'online' }}" alt="" />
                            <p>{{ Auth::user()->name}}</p>
                        </a>
                    </div>
                    <a class="logout_sign" href="{{ route('logout') }}" title="Log out">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div id="search">
                <form class="search" method="POST" action="{{ route('chat', ['user_id' => Auth::user()->id]) }}">
                    @csrf
                    <label for=""></label>
                    <input type="tel" name="search_contact" placeholder="Search contacts..." />
                    <button class="btn btn_search" type="submit"><i class="fa fa-search"
                            aria-hidden="true"></i>Search</button>
                </form>
            </div>
            <div id="contacts">

                @if($search_contact === '')
                <?php $search_contact = []; ?>
                @endif
                @if(count($search_contact))
                <ul class="search_contacts">
                    <div class="search_wrap">
                        <h4 class="search_result">Результат поиска:</h4>
                        <a href="{{ route('chat', ['user_id' => Auth::user()->id]) }}" title="close">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </a>
                    </div>
                    @foreach($search_contact as $contact)

                    <li class="contact">
                        <div class="wrap">
                            <a href="{{ route('chat.user', ['friend_id' => "$contact->id"]) }}">
                                <span
                                    class="contact-status {{ (isset($search_contact) || $contact->isOnline()) ? 'online' : 'ofline' }}"></span>
                                <img src="
                                    {{ (!isset($contact->photo)) ? asset('photo/no-avatar.jpg') : $contact->photo }}"
                                    alt="" />
                                <div class="meta">
                                    <p class="name">{{ $contact->name }}</p>
                                    <p class="preview"></p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <hr style="background-color:white">
                    @endforeach

                </ul>
                @elseif(!empty($search_contact))
                <ul class="search_contacts">
                    <div class="search_wrap">
                        <h4 class="search_result">Результат поиска:</h4>
                        <a href="{{ route('chat', ['user_id' => Auth::user()->id]) }}" title="close">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </a>
                    </div>
                    <p>Контакт не найден</p>
                    <hr style="background-color:white">
                </ul>
                @endif
                <ul>
                    <h4>Ваши контакты:</h4>
                    <!-- All friends -->
                    @if(!$contacts->count())
                    <p>У вас нет контактов!</p>
                    @else
                    <?php $friend_id = ''; ?>
                    @foreach($contacts as $contact)
                    <?php $friend_id = $contact->id; ?>
                    <li class="contact">
                        <div class="wrap">
                            <?php $friend_id = ''; ?>
                            <?php $friend_id = $contact->id; ?>
                            <a href="{{ route('chat.user', ['friend_id' => "$contact->id"])}}">
                                <span
                                    class="contact-status contact-status {{ (isset($contact) || $contact->isOnline()) ? 'online' : 'ofline'}}"></span>
                                <img src="{{ (!$contact->photo) ? asset('photo/no-avatar.jpg') : $contact->photo }}"
                                    alt="" />
                                <div class="meta">
                                    <p class="name">{{ $contact->name }}</p>

                                </div>
                            </a>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div id="bottom-bar">
                <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
            </div>
        </div>
        <div class="content">
            @yield('chat')
            <!-- <div class="messages"> -->
            @if(!isset($friends))
            <div class="chat_msg">
                <div>
                    <p>Выберите чат</p>
                </div>

            </div>
            @endif
            <!-- </div> -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        let block = document.querySelectorAll(".messages");
        console.log(block);
        block[0].scrollTop = block[0].scrollHeight;
    </script>
</body>

</html>