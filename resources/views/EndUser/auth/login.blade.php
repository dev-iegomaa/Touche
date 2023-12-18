@extends('Auth.assets.master')

@section('title')
    Login | Touché
@endsection

@section('content')

    <div class="form-content">

    <h1 class="">Sign In Client</h1>
    <p class="">Log in to your account to continue.</p>
    <p class="signup-link register">Create new account? <a href="{{route('client.register')}}">Sign Up</a></p>

    <form class="text-left" method="post" action="{{route('client.login')}}">
        @csrf
        @include('Auth.assets._form')
    </form>

</div>

@endsection
