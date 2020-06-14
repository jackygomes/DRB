@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('announcment.update', $announcment->id) }}">
    @csrf
    @method('patch')
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-8">
            <div class="form-group">
            <label>Announcment</label>
            <input class="form-control" name="text"  value="{{ $announcment->text}}" type="text" placeholder="Enter Announcment Name">
            </div>

            <div class="ml-4">
                <input class="form-check-input" type="checkbox" name="is_published"  value=1 id="defaultCheck1" {{$announcment->is_published == 1 ?'checked':''}}>
                <label class="form-check-label h5" for="defaultCheck1">
                    Publish
                </label>
            </div>
        </div>

        <div class="col-md-4">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
        </div>
    </div>
</form>

@endsection
