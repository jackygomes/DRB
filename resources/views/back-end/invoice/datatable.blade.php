<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Menu List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Plan Name</th>
                <th>User Name</th>
                <th>Price</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Plan Name</th>
                <th>User Name</th>
                <th>Price</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->subscriptionplan->name }}</td>
                        <td>{{ $invoice->user->full_name }}</td>
                        <td>{{ $invoice->price }}</td>
                        <td>{{ $invoice->expire_date }}</td>
                        <td>
                            <a href="{{ route('invoice.show', $invoice->id)}}" class="btn btn-outline-primary">view</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
