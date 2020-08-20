<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Survey Answer List</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Answer</th>
                <th>Hit</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sl.</th>
                <th>Answer</th>
                <th>Hit</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($surveyansweroptions as $surveyansweroption)
                    <tr>
                        <td>{{$i++}}</td>
                        <td style="background-color:{{$surveyansweroption->color}}">{{ $surveyansweroption->answer_option }}</td>
                        <td>{{ $surveyansweroption->hit_count }}</td>
                        <td>
                            <a href="{{ route('surveyansweroption.edit', $surveyansweroption->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('surveyansweroption.destroy', $surveyansweroption->id)}}" onclick="return confirm('Are you sure, you want to delete this survey answer option?')" method="post" style="display: inline;">
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
