<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        User List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Full Name</th>
                <th>Contact Number</th>
                <th>Profession</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Full Name</th>
                <th>Contact Number</th>
                <th>Profession</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $user->full_name}}</td>
                        <td>{{ $user->contact_number}}</td>
                        <td>{{ $user->profession}}</td>
                        <td>{{ $user->institution}}</td>
                        <td>{{ $user->type}}</td>
                        <td>{{ $user->email}}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('user.destroy', $user->id)}}" onclick="return confirm('Are you sure, you want to delete this user?')" method="post" style="display: inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
