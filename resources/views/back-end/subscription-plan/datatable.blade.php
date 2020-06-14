<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Subscription List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Plan Name</th>
                <th>Price Per Month</th>
                <th>Price Per Year</th>
                <th>User Limit</th>
                <th>Visible</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Plan Name</th>
                <th>Price Per Month</th>
                <th>Price Per Year</th>
                <th>User Limit</th>
                <th>Visible</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($subscriptionplans as $subscriptionplan)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $subscriptionplan->name }}</td>
                        <td>{{ $subscriptionplan->price_per_month }}</td>
                        <td>{{ $subscriptionplan->price_per_year }}</td>
                        <td>{{ $subscriptionplan->user_limit }}</td>
                        <td>
                            @if ( $subscriptionplan->is_visible == 0)
                                No
                            @else
                                Yes
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('subscriptionplan.edit', $subscriptionplan->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('subscriptionplan.destroy', $subscriptionplan->id)}}" onclick="return confirm('Are you sure, you want to delete this subscription plan?')" method="post" style="display: inline;">
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
