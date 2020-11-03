@extends('back-end.admin-layout')

@section('content')

    <div class="row">
        <div class="col-6 offset-3" style="box-shadow: 0 0 4px #c5c5c5; padding: 15px;">
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

                <h6>Categories List</h6>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created AT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $key => $category)
                        <tr>
                            <th scope="row">{{++$key}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{$dateOrganizer->makePrettyDate($category->created_at)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    <div class="row">

    </div>
@endsection