@extends('layouts.app')
@section('title'){{$host->name}}@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    {{$host->HealthAsEmoji}}
                </div>
                <h2>{{__('Name')}}:{{$host->name}}</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>{{__('Domain')}}/{{__('IP')}}</th>
                        <td>{{$host->ip}}</td>
                    </tr>
                    <tr>
                        <th>{{__('SSH User')}}</th>
                        <td>{{$host->ssh_user}}</td>
                    </tr>
                    <tr>
                        <th>{{__('Last Check')}}</th>
                        <td>{{$host->checks->last()->last_ran_at}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <div class="float-right">
                    <a class="btn btn-success" href="{{route('server.checks.add',$host)}}">+</a>
                </div>
                <h2>{{__('Checks')}}</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>{{__('Type')}}</th>
                            <th>{{__('Last run message')}}</th>
                            <th>{{__('Last Check')}}</th>
                            <th>{{__('Next Check')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Enabled')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($host->checks as $check)
                            <tr>
                                <td>{{ucfirst($check->type)}}</td>
                                <td>{{ucfirst($check->last_run_message)}}</td>
                                <td>{{ucfirst($check->last_ran_at)}}</td>
                                @if($check->last_ran_at)
                                    <td>{{ucfirst($check->last_ran_at->addMinutes($check->next_run_in_minutes))}}</td>
                                @else
                                    <td>N/A</td>
                                @endif
                                <td>{{ucfirst($check->status)}}</td>
                                <td>{{ucfirst($check->enabled)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
