<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Attendees List</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Registered At</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Registered At</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($invoices as $key => $invoice)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$invoice->user->full_name}}</td>
                        <td>{{$invoice->user->email}}</td>
                        <td>{{$invoice->user->contact_number}}</td>
                        <td>{{$dateOrganizer->makePrettyDate($invoice->created_at)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>