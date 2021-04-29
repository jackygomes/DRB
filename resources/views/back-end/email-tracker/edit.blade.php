@extends('back-end.admin-layout')

@section('content')

    <div class="row d-flex align-items-center" style="height: 70vh">
        <div class="col-md-6 offset-md-3 global-box-shadow">
            <form  method="post" action="{{ route('email.tracker.update', $emailTracker->id) }}">
                @csrf
                <div class="row bg-white my-4 mx-1 p-3">

                        <div class="col-12">
                            <div class="form-group">
                                <label>Title<span class="text-danger">*</span> </label>
                                <input class="form-control" name="title"  value="{{ $emailTracker->title }}" type="text" placeholder="Title" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group ">
                                <label>Audience Count<span class="text-danger">*</span> </label>
                                <input pattern="[0-9]+" title="*Numbers only" class="form-control" name="num_of_audience"  value="{{ $emailTracker->num_of_audience }}" type="text" placeholder="Num of Audience" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
                        </div>
                </div>
            </form>

        </div>
    </div>

@endsection
