@extends('back-end.admin-layout')

@section('content')

<form method="POST" action="{{ route('commentAdmin.update', $comment->id) }}">
    @csrf
    @method('patch')
    <div class="row">
        <div class="col-10">
            <div class="form-group">
                <textarea class="form-control mr-5" id="exampleFormControlTextarea1" name="body" rows="1" placeholder="Write a comment...">{{$comment->body}}</textarea>
            </div>
        </div>
        <div class="col-2">
            <input type="hidden" name="news_id" value="{{$comment->news_id}}">
            <button type="submit" class="btn btn-primary float-right">Update</button>
        </div>
    </div>
</form>

@endsection