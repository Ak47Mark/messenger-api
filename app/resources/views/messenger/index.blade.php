@extends('layout')

@section('content')
<h1>Messenger</h1>

    <div id="dashboard">
        <div id="users">
            <h2>Users</h2>
            <ul id="userList">
                    <li>
                        <a href="#" class="user" onclick="selectUser()">All messages</a>
                    </li>
                @foreach($users as $user)
                    <li>
                        <a href="#" class="user" onclick="selectUser({{$user->id}})">{{$user->username}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="messages">
            <div id="msg-list">
                <h2>Messages</h2>
                <ul id="messageList">
                    @foreach($messages as $message)
                        <li>
                            <strong>{{$message->sender->username}}:</strong> {{$message->message}}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="msg-form">
                <form id="messageForm" onsubmit="event.preventDefault(); sendMessage();">
                    @csrf
                    <input type="text" name="message" id="message" autocomplete="off">
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
    

@endsection