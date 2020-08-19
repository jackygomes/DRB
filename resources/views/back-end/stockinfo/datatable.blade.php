<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Company List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Company Name</th>
                <th>Ticker</th>
                <th>Sector Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Company Name</th>
                <th>Ticker</th>
                <th>Sector Name</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->ticker }}</td>
                        @if($company->sector)
                            <td>{{ $company->sector->name }}</td>
                        @endif
                        <td>
                            <a href="{{ route('company.show', $company->id)}}" class="btn btn-outline-primary">Show</a>
                            <a href="{{ route('company.edit', $company->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('company.destroy', $company->id)}}" onclick="return confirm('Are you sure, you want to delete this menu?')" method="post" style="display: inline;">
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
