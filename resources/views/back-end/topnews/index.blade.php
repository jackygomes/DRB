@extends('back-end.admin-layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form  method="post" action="{{ route('topnews.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Heading</label>
                            <input class="form-control" name="heading"  placeholder="Enter news heading" value="{{ old('heading') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Source Url</label>
                            <input class="form-control"  name="source"  placeholder="Enter news source" value="{{ old('source') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image (Upload 350 * 200 for optimal performance. 500kb max)</label>
                            <input class="form-control-file" name="image"  type="file">
                        </div>
                    </div>

                    <div class="col-md-6">

                    </div>

                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-table"></i> Topnews</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Heading</th>
                        <th>Source</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Sl.</th>
                        <th>Heading</th>
                        <th>Source</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($topnews as $news)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$news->heading}}</td>
                            <td>{{$news->source}}</td>
                            <td>
                                <a target="_blank" href="{{env('S3_URL') . $news->image}}" class="text-primary">Topnews Image</a>
                            </td>

                            @if(Auth::user()->type == 'admin' )
                                <td>
                                    <a href="{{route('topnews.edit', $news->id)}}" class="btn-sm btn-info">Edit</a>
                                    <a onclick="confirm('Are You Sure?')" href="{{route('topnews.delete', $news->id)}}" class="btn-sm btn-danger">Delete</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

@endsection