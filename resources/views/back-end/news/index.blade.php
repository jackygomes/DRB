@extends('back-end.admin-layout')

@section('content')
<a class="btn btn-primary" href="{{route('category.index')}}">News Category</a>
<form  method="post" action="{{ route('news.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-4">
            <div class="form-group">
                <label>Image</label>
                <input class="form-control" name="image"  type="file">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label>Heading</label>
            <textarea class="form-control" rows="1" name="heading"  placeholder="Enter news heading">{{ old('heading') }}</textarea>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <label>Source</label>
            <textarea class="form-control" rows="1" name="source"  placeholder="Enter news source">{{ old('source') }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Name of Source</label>
                <textarea class="form-control" rows="5" name="body" placeholder="Enter name of source of the news">{{ old('body') }}</textarea>
            </div>
        </div>

        <div class="col-md-5">
            <h6>Where to show in Home page</h6>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="showing_area" id="exampleRadios6" value="top5" >
                <label class="form-check-label mr-4" for="exampleRadios6">
                  Top News
                </label>
                <input class="form-check-input" type="radio" name="showing_area" id="exampleRadios2" value="world" >
                <label class="form-check-label mr-4" for="exampleRadios2">
                  World
                </label>
                <input class="form-check-input" type="radio" name="showing_area" id="exampleRadios3" value="country" >
                <label class="form-check-label mr-4" for="exampleRadios3">
                  Country
                </label>
                <input class="form-check-input" type="radio" name="showing_area" id="exampleRadios4" value="economy" >
                <label class="form-check-label mr-4" for="exampleRadios4">
                  Economy
                </label>
                <input class="form-check-input" type="radio" name="showing_area" id="exampleRadios5" value="company" >
                <label class="form-check-label mr-4" for="exampleRadios5">
                  Company
                </label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group ">
                <label>Select Category:<span class="text-danger">*</span> </label>
                <select class="form-control dropdown-custom" name="category_id" require>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"  {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->name}}</option>
                @endforeach
                </select>
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

@include('back-end.news.datatable')

@endsection