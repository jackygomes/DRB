@extends('back-end.admin-layout')

@section('content')
    <div class="row">
        <div class="col-4 offset-4">
            @if(Session::has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-table"></i> Payment List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Invoice Code</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>User Limit</th>
                        <th>Status</th>
                        <th>Ordered At</th>
                        <th>Expire Date</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $key => $invoice)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$invoice->unique_id}}</td>
                            <td>{{$invoice->price}}</td>
                            <td>{{$invoice->type}}</td>
                            <td>{{$invoice->user_limit}}</td>
                            <td>Pending..</td>
                            <td>{{\Carbon\Carbon::parse($invoice->created_at)->format('d F Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($invoice->expire_date)->format('d F Y')}}</td>
                            <td>
                                <a href="{{route('offline.payments.details', $invoice->id)}}"
                                   class="btn btn-outline-info">Details</a>
                                <a href="{{route('offline.payments.approve', $invoice->id)}}"
                                   class="btn btn-outline-warning">Approve</a>
                                <a href="javascript:void(0)"
                                   onclick='deleteInvoice("{{route('offline.payments.delete', $invoice->id)}}")'
                                   class="btn btn-outline-danger">Delete</a>
                            </td>

                        </tr>
                    @endforeach
                    @if(count($invoices) == 0)
                        <h5 class="text-center text-muted">No Invoice to Show</h5>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>

    function deleteInvoice(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {

                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 200) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            window.location.reload()
                        }
                    })

            }
        })
    }

</script>
