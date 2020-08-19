@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('menu.update', $menu->id) }}">
    @csrf
    @method('patch')
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-5">
            <div class="form-group">
            <label>Menu Name</label>
            <input class="form-control" name="title"  value="{{ $menu->title}}" type="text" placeholder="Enter Menu Name">
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group ">
                <label>Parent Menu:<span class="text-danger">*</span> </label>
                <select class="form-control dropdown-custom" name="parent_menu_id" require>
                    @if(!$menu->parent_menu_id)
                        <option value="" selected>No Parent Menu</option>
                    @else
                        <option value="">No Parent Menu</option>
                    @endif
                    @foreach($allmenus as $allmenu)
                        @if ($menu->parent_menu_id == $allmenu->id))
                            <option value="{{$allmenu->id}}" selected>{{$allmenu->title}}</option>
                        @else
                            <option value="{{$allmenu->id}}">{{$allmenu->title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
        </div>
    </div>
</form>

@endsection
