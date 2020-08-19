@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('page.update', $page->id) }}">
    @csrf
    @method('patch')
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-4">
            <div class="form-group">
            <label>Page Name</label>
            <input class="form-control" name="title"  value="{{ $page->title }}" type="text" placeholder="Enter Menu Name">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group ">
                <label>Parent Page:<span class="text-danger">*</span> </label>
                <select class="form-control dropdown-custom" name="menu_id" require>
                    @foreach($menus as $menu)
                        @if (($page->menu->id) == $menu->id))
                            <option value="{{$menu->id}}" selected>{{$menu->title}}</option>
                        @else
                            <option value="{{$menu->id}}">{{$menu->title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="1" name="description" placeholder="Enter page description">{{ $page->description }}</textarea>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <label>Slug</label>
            <input class="form-control" name="slug"  value="{{ $page->slug }}" type="text" placeholder="Enter unique slug">
            </div>
        </div>

        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
        </div>
    </div>
</form>

@endsection
