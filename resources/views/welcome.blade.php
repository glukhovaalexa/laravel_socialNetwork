@extends('layouts.master')
@section('content')
<form class="form-signin" method="POST">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control mb-2" placeholder="Email address" required=""
        autofocus="">

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control mb-4" placeholder="Password"
        required="">

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

@endsection