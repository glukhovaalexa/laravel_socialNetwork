@extends('layouts.master')
@section('content')
<!-- <form class="form-signin" method="POST" action=" {{ route('register.prove.form') }}" novalidate> -->
    @csrf
    <!-- <h1 class="h3 mb-3 font-weight-normal">Please enter code form sms</h1>

    <label for="inputCode" class="sr-only">Code</label>
    <input type="text" name="code" id="inputCode"
        class="form-control mb-2 " placeholder="Code" required=""
        autofocus="" value="">

    <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Submit</button>
</form> -->

@endsection