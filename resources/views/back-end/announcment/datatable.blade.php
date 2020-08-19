<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Announcment List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Announcment</th>
                <th>Publish</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Announcment</th>
                <th>Publish</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($announcments as $announcment)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $announcment->text }}</td>
                        <td>
                            @if ( $announcment->is_published == 0)
                                No
                            @else
                                Yes
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('announcment.edit', $announcment->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('announcment.destroy', $announcment->id)}}" onclick="return confirm('Are you sure, you want to delete this announcment?')" method="post" style="display: inline;">
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
