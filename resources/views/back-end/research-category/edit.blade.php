@extends('back-end.admin-layout')

@section('content')
    <?php $i = 1 ?>
    <div class="row">
        <div class="col-md-12">
            <h2>Create Research Category</h2>
            <form  method="post" action="{{route('admin.research.category.update', $category->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="bg-white my-4 mx-1 p-3 shadow-sm">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="name" value="{{$category->name}}" type="text" placeholder="Enter Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
