@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('company.store') }}">
    @csrf
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-3">
            <div class="form-group">
            <label>Company Name</label>
            <input class="form-control" name="name"  value="{{ old('name') }}" type="text" placeholder="Enter Company Name">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <label>Ticker </label>
            <input class="form-control" name="ticker"  value="{{ old('ticker') }}" type="text" placeholder="Enter Ticker">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group ">
                <label>Sector:<span class="text-danger">*</span> </label>
                <select class="form-control dropdown-custom" name="sector_id" require>
                <option value="">Choose Sector</option>
                @foreach($sectors as $sector)
                    <option value="{{$sector->id}}"  {{ (old("sector_id") == $sector->id ? "selected":"") }}>{{$sector->name}}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
        </div>
    </div>
</form>
@include('back-end.company.datatable')

@endsection
