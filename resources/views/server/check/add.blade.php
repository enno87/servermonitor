@extends('layouts.app')

@section('title'){{__('Add Check')}}@endsection
@section('content')
    <div class="container">
        <div class="card">
                <form method="post" action="{{route('server.checks.store',$host)}}">
                    @csrf()
                    <div class="card-header">
                        {{__('Add Checks')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="required" for="types">{{__('Checks')}}</label>
                            <select multiple class="form-control custom-select" id="types" name="name[]" required>
                                @foreach ($availableChecks as $check)
                                    <option value="{{$check}}" {!! in_array($check,old('types',[])) ? 'selected=""' :'' !!}>{{ucfirst($check)}}</option>
                                @endforeach
                            </select>
                            <small>{{__('Hold control for multiple select.')}}</small>
                            @if($errors->has('name'))
                                <p class="text-danger font-weight-bold">{{$errors->first('name')}}</p>
                            @elseif($errors->any())
                                <p class="text-danger font-weight-bold">{{__('Wrong value')}}</p>
                            @endif

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <input type="submit" class="btn btn-primary" value="{{__('Store')}}">
                        </div>
                        <a href="{{route('server.show',$host)}}" class="btn btn-secondary">{{__('Cancel')}}</a>
                    </div>
                </form>
          </div>
        </form>
    </div>
@endsection
