@extends('back-end.admin-layout')

@section('content')
    <div class="text-right mb-2">
        <a class="btn btn-primary" href="{{route('newsletter.create')}}">Create</a>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Newsletter List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Publishing Date</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($newsletters as $newsletter)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$newsletter->title}}</td>
                            <td>{{$newsletter->category->category}}</td>
                            <td>{{$newsletter->type}}</td>
                            <td>{{\Carbon\Carbon::parse($newsletter->publishing_date)->format('d M y h:i A')}}</td>
                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$newsletter->created_at)->format('d M y h:i A')}}</td>
                            <td>
                                <a href="{{ route('newsletter.edit', $newsletter->id)}}" class="btn btn-outline-primary">Edit</a>
                                <a onclick="return confirm('Are you sure, you want to delete this news?')" href="{{ route('newsletter.delete', $newsletter->id)}}" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="float-right">{{$newsletters->links()}}</div>
        </div>
        {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
    </div>

@endsection