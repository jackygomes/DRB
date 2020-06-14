<?php $i = 1 ; ?>
<div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Page Item List</div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Particular</th>
                        <th>PDF</th>
                        <th>Excel</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sl.</th>
                        <th>Particular</th>
                        <th>PDF</th>
                        <th>Excel</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($pageitems as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $item->particular }}</td>
                        @if($item->pdf_file_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->pdf_file_url }}" type="button" class="btn btn-outline-primary">PDF</a></td>
                        @else
                            <td>No PDF</td>
                        @endif
                        @if($item->excel_file_url != '#')
                            <td><a target="_blank" href="{{ env('S3_URL') }}{{ $item->excel_file_url }}" type="button" class="btn btn-outline-primary">Excel</a></td>
                        @else
                            <td>No Excel</td>
                        @endif
                        <td>
                            <form action="{{ route('page-item.destroy', $item->id)}}" onclick="return confirm('Are you sure, you want to delete this item?')" method="post" style="display: inline;">
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
    </div>
