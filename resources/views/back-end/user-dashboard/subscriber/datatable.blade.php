<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Survey List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($subscribers as $subscriber)
                    <tr>
                        <td>{{ $subscriber->user->full_name }}</td>
                        <td>{{ $subscriber->user->email }}</td>
                        <td>
                            <form action="{{ route('subscriber.destroy', $subscriber->id)}}" onclick="return confirm('Are you sure, you want to unsubscriber this user?')" method="post" style="display: inline;">
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
