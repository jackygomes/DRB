@extends('back-end.admin-layout')

@section('content')

<div class="row bg-white my-4  p-3 shadow-sm">
    <div class="col-md-8">
        <div class="form-group">
        <label>Company Name: {{ $company->name }}</label>
    </div>

    <div class="col-md-8">
        <div class="form-group ">
            <label>Ticker: {{ $company->ticker }} </label>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label>Sector: {{ $company->sector->name }}</label>
        </div>
    </div>
</div>
<div class="row bg-white my-4  p-3 shadow-sm">
    <form  method="post" action="{{ route('finance-info.store') }}" enctype="multipart/form-data">
        @csrf
        <input name="company_id" value="{{$company->id}}" type="hidden" >
        <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
            <div class="col-md-8">
                <div class="form-group">
                <label>Year</label>
                <input class="form-control" name="year"  value="{{ old('year') }}" type="number" placeholder="Enter year">
                </div>
            </div>
            <div class="col-md-4">
                <label></label>
                <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
            </div>
        </div>
    </form>
</div>

@include('back-end.company.finance-info-datatable')

@endsection
