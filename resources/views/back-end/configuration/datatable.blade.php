<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Configuration List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Key</th>
                <th>Value</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Key</th>
                <th>Value</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($keyvaluepairs as $keyvaluepair)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $keyvaluepair->key }}</td>
                        <td>{{ $keyvaluepair->value }}</td>
                        <td>
                            <a href="{{ route('configuration.edit', $keyvaluepair->id)}}" class="btn btn-outline-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
