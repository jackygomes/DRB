@extends('back-end.admin-layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="" class="btn btn-outline-primary mb-4">
            <span class="fa-clickable" data-toggle="modal" data-target="#academics">
                <i class="fas fa-pen"></i><small>Add Research</small>
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
                    <th>Excel File</th>
                    <th>PDF File</th>
                    <th>Action</th>
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
                    <th>Excel File</th>
                    <th>PDF File</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Jacky</td>
                        <td>ticker</td>
                        <td>sector</td>
                        <td>Provider</td>
                        <td>Category</td>
                        <td>Date</td>
                        <td>Jacky, Simon</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                        <td>file</td>
                        <td>file</td>
                        <td>
                            <a href="" class="btn btn-outline-primary">view</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Jacky</td>
                        <td>ticker</td>
                        <td>sector</td>
                        <td>Provider</td>
                        <td>Category</td>
                        <td>Date</td>
                        <td>Jacky, Simon</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                        <td>file</td>
                        <td>file</td>
                        <td>
                            <a href="" class="btn btn-outline-primary">view</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>


@endsection
