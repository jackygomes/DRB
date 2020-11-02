@extends('back-end.admin-layout')

@section('content')

    <div class="row">
        <div class="col-6 offset-3">
            @if(Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
            <form  method="post" action="{{route('tutorials.create.category.post')}}">
                @csrf
                <div class="bg-white my-4 mx-1 p-3 shadow-sm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Add Tutorial Category</label>
                                <input class="form-control" name="name" type="text" placeholder="Category Name" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection