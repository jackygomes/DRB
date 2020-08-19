@extends('back-end.admin-layout')

@section('content')
    <?php $i = 1 ?>
    <div class="row">
        <div class="col-md-12">
            <h2>Create Research Category</h2>
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{$message}}
                </div>
            @elseif($message = Session::get('failed'))
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @endif
            <form  method="post" action="{{route('admin.research.category.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="bg-white my-4 mx-1 p-3 shadow-sm">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Create</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-table"></i> Category List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                <a href="{{ route('admin.research.category.edit', $category->id)}}" class="btn btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.research.category.delete', $category->id)}}" onclick="return confirm('Are you sure, you want to delete this user?')" method="post" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if(count($categories) == 0)
                        <h5 class="text-center text-muted">No Category to Show</h5>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>


@endsection
