@extends('back-end.admin-layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{route('user.create')}}" class="btn btn-outline-primary mb-4">
        <span class="fa-clickable" data-toggle="modal" data-target="#academics">
            <i class="fas fa-pen"></i>Add User
        </span>
        </a>
    </div>
</div>
@include('back-end.user.datatable')

@endsection
