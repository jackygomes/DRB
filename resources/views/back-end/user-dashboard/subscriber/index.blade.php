@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('invoice.postuser') }}">
    @csrf
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-3">
            <div class="form-group">
            <label>User Email</label>
            <input class="form-control" name="email"  value="{{ old('email') }}" type="email" placeholder="Enter User Email">
            </div>
        </div>

        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
        </div>
    </div>
</form>
@include('back-end.user-dashboard.subscriber.datatable')

@endsection
