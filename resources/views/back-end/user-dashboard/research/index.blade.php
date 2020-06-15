@extends('back-end.admin-layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{route('research.create')}}" class="btn btn-outline-primary mb-4">
            <span class="fa-clickable" data-toggle="modal" data-target="#academics">
                <i class="fas fa-pen"></i>Add Research
            </span>
        </a>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i>Menu List</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Ticker</th>
                    <th>Sector</th>
                    <th>Provider</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Analysts</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Excel File</th>
                    <th>PDF File</th>
                    @if(Auth::user()->type == 'admin' )
                        <th>Action</th>
                    @endif
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Ticker</th>
                    <th>Sector</th>
                    <th>Provider</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Analysts</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Excel File</th>
                    <th>PDF File</th>
                    @if(Auth::user()->type == 'admin' )
                        <th>Action</th>
                    @endif
                </tr>
                </tfoot>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->company->ticker}}</td>
                        <td>{{$product->sector->name}}</td>
                        <td>{{$product->provider}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->date}}</td>
                        <td>
                            {{implode(', ', json_decode($product->analysts))}}
                        </td>
                        <td>{{$product->description}}</td>
                        <td><span class="badge {{$product->status =='Approved'? 'badge-success': 'badge-warning'}}">{{$product->status}}</span></td>
                        <td>file</td>
                        <td>file</td>
                        @if(Auth::user()->type == 'admin' )
                            <td>
                                <a href="" class="btn btn-outline-primary">Edit</a>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                    @if(count($products) == 0)
                        <h5 class="text-center text-muted">No Toolkit to Show</h5>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>


@endsection
