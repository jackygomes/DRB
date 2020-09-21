@extends('back-end.admin-layout')

@section('content')
    @if(Session::has('success'))
        <div class="col-md-6 offset-3 col-12">
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Menu List

            <a class="btn btn-warning float-right" href="{{route('newspapers.create')}}">Add</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Newspapers</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($newspapers as $key => $newspaper)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{ $newspaper->name }}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('newspapers.edit', $newspaper->id)}}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection