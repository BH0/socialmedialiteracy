@extends('layouts.master')

@section('content')
    Results 
    "{{ Request::input('query') }}" 
    @if (!$users->count())
        <b>No user found</b> 
    @else 
        </div> 
            @foreach ($users as $user) 
                <p>@include('includes.userblock') </p> 
            @endforeach 
        </div> 
    @endif 
@endsection 