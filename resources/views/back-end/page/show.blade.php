@extends('back-end.admin-layout')

@section('content')

<div class="row bg-white my-4  p-3 shadow-sm">
    <div class="col-md-8">
        <div class="form-group">
        <label>Menu Name: {{ $page->title }}</label>
    </div>

    <div class="col-md-8">
        <div class="form-group ">
            <label>Menu: {{$page->menu->title}} </label>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label>Description: {{ $page->description }}</label>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label>Slug: {{ $page->slug }}</label>
        </div>
    </div>
</div>
<div class="row bg-white my-4  p-3 shadow-sm">
    <form  method="post" action="{{ route('page-item.store') }}" enctype="multipart/form-data">
        @csrf
        <input name="page_id" value="{{$page->id}}" type="hidden" >
        <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
            <div class="col-md-4">
                <div class="form-group">
                <label>Particular</label>
                <input class="form-control" name="particular"  value="{{ old('particular') }}" type="text" placeholder="Enter a short description">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>PDF</label>
                <input class="form-control" name="pdf"  type="file">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Excel</label>
                <input class="form-control" name="excel" type="file">
                </div>
            </div>
            <div class="col-md-2">
                <label></label>
                <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
            </div>
        </div>
    </form>
</div>

@include('back-end.page.page-item-datatable')

@endsection
