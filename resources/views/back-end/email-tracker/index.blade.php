@extends('back-end.admin-layout')

@section('content')

    <form  method="post" action="{{ route('email.tracker.store') }}">
        @csrf
        <div class="row bg-white my-4 mx-1 p-3 global-box-shadow">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Title<span class="text-danger">*</span> </label>
                    <input class="form-control" name="title"  value="{{ old('title') }}" type="text" placeholder="Title" required>
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group ">
                    <label>Audience Count<span class="text-danger">*</span> </label>
                    <input pattern="[0-9]+" title="*Numbers only" class="form-control" name="num_of_audience"  value="{{ old('num_of_audience') }}" type="text" placeholder="Num of Audience" required>
                </div>
            </div>

            <div class="col-md-2">
                <label></label>
                <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Create</button>
            </div>
        </div>
    </form>
    @include('back-end.email-tracker.datatable')

@endsection
