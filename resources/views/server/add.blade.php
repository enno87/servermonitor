@extends('layouts.app')

@section('title'){{__('Add Host')}}@endsection

@section('content')
    <div class="container">
        <form class="form" action="{{route('server.store')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h1>{{__('Add new server')}}
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label class="required" for="name">{{__('Name')}}</label>
                        <input type="name" class="@error('name') is-invalid @enderror form-control " id="name" name="name" value="{{old('name')}}" required>
                        @if($errors->has('name'))
                            <p class="text-danger font-weight-bold">{{$errors->first('name')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="ssh_user">{{__('SSH User')}}</label>
                        <input required type="ssh_user" class="form-control @error('ssh_user') is-invalid @enderror" id="ssh_user" name="ssh_user" value="{{old('ssh_user')}}">
                        @if($errors->has('ssh_user'))
                            <p class="text-danger font-weight-bold">{{$errors->first('ssh_user')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="ip">{{__('IP')}}</label>
                        <input required type="ip" class="form-control @error('ip') is-invalid @enderror" id="ip" name="ip" value="{{old('ip')}}">
                        @if($errors->has('ip'))
                            <p class="text-danger font-weight-bold">{{$errors->first('ip')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="port">{{__('Port')}}</label>
                        <input type="port" class="form-control @error('port') is-invalid @enderror" id="port" name="port" value="{{old('port')}}">
                        @if($errors->has('port'))
                            <p class="text-danger font-weight-bold">{{$errors->first('port')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="checks">{{__('Checks')}}</label>
                        <select multiple class="form-control custom-select  @error('port') is-invalid @enderror" id="checks" name="checks[]" required>
                            @foreach ($checks as $check)
                                <option value="{{$check}}" {!! in_array($check,old('checks',[])) ? 'selected=""' :'' !!}>{{ucfirst($check)}}</option>
                            @endforeach
                        </select>
                        <small>{{__('Hold control for multiple select.')}}</small>
                        @if($errors->has('checks'))
                            <p class="text-danger font-weight-bold">{{$errors->first('checks')}}</p>
                        @endif
                        @if($errors->has('checks.*'))
                            <p class="text-danger font-weight-bold">{{$errors->first('checks.*')}}</p>
                        @endif

                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('server.index')}}" class="btn btn-secondary">{{__('Cancel')}}</a>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">{{__('Store')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
