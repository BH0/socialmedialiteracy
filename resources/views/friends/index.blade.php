@extends('layouts.master') 

@section('content') 
    <div> 
        <h3>Your Friends </h3> 
        @if (!$friends->count()) 
            <p>You have no friends</p> 
        @else 
            @foreach ($friends as $user) 
                @include('includes.userblock') 
            @endforeach 
        @endif 
    </div> 
    <div> 
        <h3>Your Friends</h3> 
        @if (Auth::user()->hasFriendRequestPending($user)) 
            <p>Waiting for {{ $user->email }} to accept...</p> 
        @elseif (Auth::user()->hasFriendRequestReceived($user)) 
            <a href="{{ route('friend.accept', ['username' => $user->email]) }}">Become friend</a> 
        @elseif (Auth::user()->id != $user->id) 
            <a href="{{ route('friend.add', ['username' => $user->email]) }}">Add friend</a> 
        @endif 

        @if (!$requests->count()) 
            <p>You have no friends</p> 
        @else 
            @foreach ($requests as $user)
                @include('includes.userblock') 
            @endforeach 
        @endif 
    </div> 
@endsection 