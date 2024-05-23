<!-- resources/views/auth/login.blade.php -->

@extends('firebase.app')

@section('content')
<form method="POST" action="{{ url('login') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <button type="submit">Login</button>
</form>
@endsection