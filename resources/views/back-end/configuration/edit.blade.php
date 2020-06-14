@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('configuration.update', $keyvaluepair->id) }}">
    @csrf
    @method('patch')
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-10">
            <div class="form-group">
            <label>{{ $keyvaluepair->key }}</label>
            <input class="form-control" name="value"  value="{{ $keyvaluepair->value }}" type="text" placeholder="Enter value">
            </div>
        </div>
        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
        </div>
    </div>
</form>

@endsection
