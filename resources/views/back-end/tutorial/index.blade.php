@extends('back-end.admin-layout')

@section('content')

    <div class="ml-3">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                {{$message}}
            </div>
        @endif
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('tutorial.create')}}" class="btn btn-outline-primary mb-4">
            <span class="fa-clickable" data-toggle="modal" data-target="#academics">
                <i class="fas fa-pen"></i> Add Tutorial
            </span>
            </a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-table"></i> Research List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($tutorials as $key => $tutorial)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$tutorial->name}}</td>
                            <td>{{$dateOrganizer->makePrettyDate($tutorial->date)}}</td>
                            <td>{{$tutorial->price}} BDT</td>
                            <td>{{$dateOrganizer->makePrettyDate($tutorial->created_at)}}</td>
                            <td>{{$tutorial->status ? 'Active' : "Inactive"}}</td>

                            @if(Auth::user()->type == 'admin' )
                                <td>
                                    <a href="{{route('tutorial.update.status', $tutorial->id)}}" class="btn-sm btn-warning mr-2">
                                        {{$tutorial->status ? 'Deactivate' : 'Activate'}}
                                    </a>
                                    <a href="{{route('tutorial.details', $tutorial->id)}}" class="btn-sm btn-info">View</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                    @if(count($tutorials) == 0)
                        <h5 class="text-center text-muted">No Research to Show</h5>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    </div>

@endsection
