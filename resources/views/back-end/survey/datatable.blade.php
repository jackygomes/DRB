<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Survey List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Survey Name</th>
                <th>Survey Description</th>
                <th>Publish</th>
                <th>Accepting Answer</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Survey Name</th>
                <th>Survey Description</th>
                <th>Publish</th>
                <th>Accepting Answer</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($surveys as $survey)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $survey->title }}</td>
                        <td>{{ $survey->description }}</td>
                        <td>
                            @if ( $survey->is_published == 0)
                                No
                            @else
                                Yes
                            @endif
                        </td>
                        <td>
                            @if ( $survey->is_accepting_answer == 0)
                                No
                            @else
                                Yes
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('survey.show', $survey->id)}}" class="btn btn-outline-primary">View</a>
                            <a href="{{ route('survey.edit', $survey->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('survey.destroy', $survey->id)}}" onclick="return confirm('Are you sure, you want to delete this survey?')" method="post" style="display: inline;">
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
