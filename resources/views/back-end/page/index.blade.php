@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('page.store') }}">
    @csrf
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-4">
            <div class="form-group">
            <label>Page Title</label>
            <input class="form-control" name="title"  value="{{ old('title') }}" type="text" placeholder="Enter Menu Name">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group ">
                <label>Menu:<span class="text-danger">*</span> </label>
                <select class="form-control dropdown-custom" name="menu_id" require>
                <option value="">Choose Menu</option>
                @foreach($menus as $menu)
                    <option value="{{$menu->id}}"  {{ (old("parent_menu_id") == $menu->id ? "selected":"") }}>{{$menu->title}}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="1" name="description" placeholder="Enter page description">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <label>Slug</label>
            <input class="form-control" name="slug"  value="{{ old('slug') }}" type="text" placeholder="Enter unique slug">
            </div>
        </div>

        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
        </div>
    </div>
</form>
@include('back-end.page.datatable')

@endsection
