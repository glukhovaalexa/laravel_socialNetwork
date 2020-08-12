@extends('layouts.master')
@section('content')
<form class="form-signin" method="POST" novalidate>
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail"
        class="form-control mb-2 {{ $errors->has('email') ? 'is-invalid': '' }}" placeholder="Email address" required=""
        autofocus="" value="{{ Request::old('email') }}">
    @if($errors->has('email'))
    <div class="alert alert-danger p-0">
        {{ $errors->first('email') }}
    </div>
    @endif

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword"
        class="form-control mb-2 {{ $errors->has('password') ? 'is-invalid': '' }}" placeholder="Password" required="" value="{{ Request::old('password') }}">
    @if($errors->has('password'))
    <div class="alert alert-danger p-0">
        {{ $errors->first('password') }}
    </div>
    @endif

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

@endsection