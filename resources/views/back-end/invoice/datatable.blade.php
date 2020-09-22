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
                <th>Id</th>
                <th>Plan Name</th>
                <th>User Name</th>
                <th>Price</th>
                <th>Order Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Plan Name</th>
                <th>User Name</th>
                <th>Price</th>
                <th>Order Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($invoices as $key => $invoice)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{ $invoice->subscriptionplan->name }}</td>
                        <td>{{ isset($invoice->user->full_name) ? $invoice->user->full_name : '' }}</td>
                        <td>{{ $invoice->price }}</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->expire_date)->format('d M Y') }}</td>
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
