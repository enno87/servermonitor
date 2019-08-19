@extends('layouts.app')
@section('title') {{__('Server Overview')}} @endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <a href="{{route('server.add')}}" class="btn btn-success" name="button">+</a>
                </div>
                <h1>{{__('Servers')}}</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                {{__('Name')}}
                            </th>
                            <th>
                                {{__('Domain')}}/{{__('IP')}}
                            </th>
                            <th>
                                {{__('SSH User')}}
                            </th>
                            <th>
                                {{__('Last Check')}}
                            </th>
                            <th>
                                {{__('Status')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hosts as $host)
                            <tr>
                                <td><a href="{{route('server.show',$host)}}">{{$host->name}}</a></td>
                                <td>{{$host->ip}}</td>
                                <td>{{$host->ssh_user}}</td>
                                <td>{{$host->checks->last()->last_ran_at}}</td>
                                <td>{{$host->HealthAsEmoji}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                {{__('Name')}}
                            </th>
                            <th>
                                {{__('Domain')}}/{{__('IP')}}
                            </th>
                            <th>
                                {{__('SSH User')}}
                            </th>
                            <th>
                                {{__('Last Check')}}
                            </th>
                            <th>
                                {{__('Status')}}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
