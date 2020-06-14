<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Survey Question List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Question</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Question</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($surveyquestions as $surveyquestion)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $surveyquestion->question }}</td>
                        <td>
                            <a href="{{ route('surveyquestion.show', $surveyquestion->id)}}" class="btn btn-outline-primary">View</a>
                            <a href="{{ route('surveyquestion.edit', $surveyquestion->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('surveyquestion.destroy', $surveyquestion->id)}}" onclick="return confirm('Are you sure, you want to delete this survey question?')" method="post" style="display: inline;">
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
