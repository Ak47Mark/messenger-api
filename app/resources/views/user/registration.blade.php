@extends('layout')

@section('content')
<h1>Registration</h1>

@error('name')
<div class="alert alert-warning">{{ $message }}</div>
@enderror

<form id="registrationForm" class="user" onsubmit="event.preventDefault(); sendRegistration();">
    @csrf
    <fieldset>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
    </fieldset>
    <fieldset>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </fieldset>
    <fieldset>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" autocomplete="new-password">
    </fieldset>
    <button type="submit">Registration</button>
    <a href="/">Login</a>
</form>
@endsection