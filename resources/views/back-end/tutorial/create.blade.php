@extends('back-end.admin-layout')

@section('content')
    <style>
        #add_button{
            float: right;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            padding: 4px 10px;
        }
    </style>
    <h4 class="ml-3">Create Tutorial</h4>
    @if($message = Session::get('success'))
        <div class="row ml-3">
            <div class="alert alert-success col-md-4">
                {{$message}}
            </div>
        </div>
    @endif
    <form  method="post" action="{{route('tutorials.create.post')}}" enctype="multipart/form-data">
        @csrf
        <div class="bg-white my-4 mx-1 p-3 shadow-sm">

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name" type="text" placeholder="Enter Name" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-control-file" name="tutorial_image" type="file" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Categories</label>
                        <select class="form-control" name="tutorial_category_id" required>
                            <option value="">Select Category</option>
                            @foreach($tutorialCategories as $tutorialCategory)
                                <option value="{{$tutorialCategory->id}}">{{$tutorialCategory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Date</label>
                        <input class="form-control" name="date" type="datetime-local" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Trainer</label>
                        <div class="analyst-input">
                            <input class="form-control mt-1" name="trainers[]" type="text" placeholder="Trainer Name">
                        </div>
                        <a id="add_button" class="mt-md-2 badge badge-primary">Add Trainer</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" placeholder="Description (Max 250 words)" rows="3" required></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Who Should Attend</label>
                        <textarea class="form-control" name="attendees" placeholder="Who Should Attend (Max 250 words)" rows="3" required></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Curriculum</label>
                        <textarea class="form-control" name="curriculum" placeholder="Curriculum" rows="5" required></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Requirements</label>
                        <textarea class="form-control" name="requirement" placeholder="Requirements" rows="5" required></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Price</label>
                        <input id="price" class="form-control" name="price" placeholder="Enter Price" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary w-50 mt-md-2">Submit</button>
                </div>
            </div>
        </div>

    </form>

@endsection

@section('scripts')
    <script type="application/javascript">
        $(document).ready(function(){
            $('#add_button').click(function(e) {
                e.preventDefault();
                $('.analyst-input').append('<input class="form-control mt-1" name="trainers[]" type="text" placeholder="Add Another Trainer">');
            });
        });
    </script>
@endsection
