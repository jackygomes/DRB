@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('menu.store') }}">
    @csrf
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-5">
            <div class="form-group">
            <label>Menu Name</label>
            <input class="form-control" name="title"  value="{{ old('title') }}" type="text" placeholder="Enter Menu Name">
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group ">
                <label>Parent Menu:<span class="text-danger">*</span> </label>
                <select class="form-control dropdown-custom" name="parent_menu_id" require>
                    <option value="">Choose Menu</option>
                    @foreach($menus as $menu)
                        <option value="{{$menu->id}}"  {{ (old("parent_menu_id") == $menu->id ? "selected":"") }}>{{$menu->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
        </div>
    </div>
</form>
@include('back-end.menu.datatable')

@endsection
