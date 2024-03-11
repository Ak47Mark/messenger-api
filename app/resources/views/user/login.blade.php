@extends('layout')

@section('content')
<h1>Login</h1>

@error('name')
<div class="alert alert-warning">{{ $message }}</div>
@enderror

<form id="loginForm" class="user" onsubmit="event.preventDefault(); sendLogin();">
    @csrf
    <fieldset>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </fieldset>
    <fieldset>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </fieldset>
    <button type="submit">Login</button>
    <a href="/registration">Sign up</a>
</form>
@endsection