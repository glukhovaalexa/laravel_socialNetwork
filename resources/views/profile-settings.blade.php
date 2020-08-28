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
    <div class="container">
        <div class="row">
            <div class="setting_logout">
            
                <div class="col-12">
                    <a class="logout_sign" href="{{ route('exit-settings', ['user_id' => Auth::user()->id]) }}"
                        title="Back to chat">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <form class="settings_form" action="{{ route('profile.settings', ['user_id' => Auth::user()->id]) }}"
            method="post" enctype='multipart/form-data'>
            @csrf

            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="settings_wrap">
                            <div class="col-10">
                                <div class="settings_img_wrap">
                                    <img id="profile-img"
                                        src="{{ (!Auth::user()->photo) ? asset('photo/no-avatar.jpg') :   Auth::user()->photo }}"
                                        class="{{ (!Auth::check()) ? 'offline' : 'online' }}" alt="" />
                                    <input type="file" class="change_img" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="center_box">
                        <label for="name" class="sr-only">Change name</label>
                        <input type="text" name="name" class="form-control mb-2" placeholder="Change name" autofocus="">
                        <label for=" name" class="sr-only">Change country</label>
                        <input type="text" name="country" class="form-control mb-2" placeholder="Change country"
                            autofocus="">
                        <div class="row">
                            <div class="col-12">
                                <div class="btn_wrapp">
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Add changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>