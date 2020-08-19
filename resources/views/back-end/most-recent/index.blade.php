@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('recent.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-4">
            <div class="form-group">
                <label>Topic</label>
                <input class="form-control" name="body"  value="{{ old('body') }}" type="text" placeholder="Enter Your Recent Topic">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Date</label>
                <input class="form-control" type="date" id="date" name="date">
            </div>
        </div>

        <div class="col-md-2 text-md-center ml-4 ml-md-0 sub-plan-check-top">
            <input class="form-check-input" type="checkbox" name="is_published" value=1 id="defaultCheck1">
            <label class="form-check-label h5" for="defaultCheck1">
                Publish
            </label>
        </div>

        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
        </div>
    </div>
</form>

@include('back-end.most-recent.datatable')

@endsection