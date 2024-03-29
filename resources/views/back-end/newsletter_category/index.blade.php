@extends('back-end.admin-layout')

@section('content')
    <div class="text-right mb-2">
        <div class="card">
            <div class="card-body">

                    <form method="post" action="{{route('nl_category.store')}}">
                        <div class="row text-left">
                            @csrf
                            <div class="col-md-8 offset-1">
                                <div class="form-group">
                                    <label for="staticEmail" >Newsletter Category</label>
                                    <div>
                                        <input name="category" type="text" class="form-control" placeholder="Category">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 offset-1">
                                <div class="form-group">
                                    <label for="staticEmail">Type</label>
                                    <div>
                                        <input name="type" type="text" class="form-control" placeholder="Type" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 offset-1">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Newsletter Categories
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($newsletterCategories as $newsletterCategory)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$newsletterCategory->category}}</td>
                            <td>{{$newsletterCategory->type}}</td>
                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$newsletterCategory->created_at)->format('d M y h:i A')}}</td>
                            <td>
                                <a href="{{ route('nl_category.edit', $newsletterCategory->id)}}" class="btn btn-outline-primary">Edit</a>
                                <a onclick="return confirm('Are you sure, you want to delete this news?')" href="{{ route('nl_category.delete', $newsletterCategory->id)}}" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--<div class="float-right">{{$newsletters->links()}}</div>--}}
        </div>
        {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
    </div>

@endsection