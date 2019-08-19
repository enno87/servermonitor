@extends('layouts.app')

@section('content')
    <div class="container">
        @php($user = Auth::user()->loadMissing('profile'))
        <h1>{{__('My Profile')}}</h1>
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th>{{__('Login')}}</th>
                <td>{{$user->username ?? 'N/A'}}
            </tr>
            <tr>
                <th>{{__('Firstname')}}</th>
                <td>{{$user->profile->firstname ?? 'N/A'}}
            </tr>
            <tr>
                <th>{{__('Lastname')}}</th>
                <td>{{$user->profile->lastname ?? 'N/A'}}
            </tr>
            <tr>
                <th>{{__('Birthday')}}</th>
                <td>
                @if($user->profile->birthday)
                    {{$user->profile->birthday->format('d.m.Y')}} ({{$user->profile->age}})
                @else
                    N/A
                @endif
            </tr>
            <tr>
                <th>{{__('E-Mail')}}</th>
                <td>{{$user->email ?? 'N/A'}}
            </tr>
        </table>
    </div>
@endsection
