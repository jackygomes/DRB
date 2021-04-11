@extends('back-end.admin-layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form  method="post" action="{{ route('topnews.update', $topnews->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Heading</label>
                            <input class="form-control" name="heading"  placeholder="Enter news heading" value="{{ $topnews->heading }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Source</label>
                            <input class="form-control"  name="source"  placeholder="Enter news source" value="{{ $topnews->source }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name of Source</label>
                            <input class="form-control" name="source_name" placeholder="Enter name of source of the news" value="{{ $topnews->source_name}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image (Upload 350 * 200 for optimal performance. 500kb max)</label>
                            <input class="form-control-file" name="image"  type="file">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection