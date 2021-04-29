<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Email Tracker List</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Audience Count</th>
                    <th>Opened</th>
                    <th>Open Ratio</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($emailTrackers as $email)
                    <tr>
                        <td>{{ $email->title }}</td>
                        <td>{{ $email->num_of_audience }}</td>
                        <td>{{$email->audiences_count}}</td>
                        <td>{{intval(($email->audiences_count/$email->num_of_audience) * 100)}}%</td>
                        <td>{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $email->created_at)->addHours(6)->format('d M y h:i A')}}</td>
                        <td>
                            <a href="{{route('email.tracker.show', $email->id)}}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{route('email.tracker.edit', $email->id)}}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="float-right">
            {{$emailTrackers->links()}}
        </div>
    </div>
</div>
