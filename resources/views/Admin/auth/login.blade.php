@extends('Auth.assets.master')

@section('content')

    <div class="form-content">

        <h1 class="">Sign In Admin</h1>
        <p class="">Log in to your account to continue.</p>

        <form class="text-left" method="post" action="{{route('auth.login')}}">
            @csrf
            @include('Auth.assets._form')
        </form>

    </div>

@endsection
