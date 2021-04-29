<div class="card">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Tracked Audience's Lists</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>name</th>
                    <th>Email</th>
                    <th>Opened At</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($emailTracker->audiences as $audience)
                    <tr>
                        <td>{{ $audience->name}}</td>
                        <td>{{ $audience->email }}</td>
                        <td>{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $audience->created_at)->addHours(6)->format('d M y h:i A')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
