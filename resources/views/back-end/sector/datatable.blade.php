<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Sector List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Sector Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Sector Name</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($sectors as $sector)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $sector->name }}</td>
                        <td>
                            <a href="{{ route('sector.edit', $sector->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('sector.destroy', $sector->id)}}" onclick="return confirm('Are you sure, you want to delete this sector?')" method="post" style="display: inline;">
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
