<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        News List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Comment By</th>
                    <th>Commnet</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Sl.</th>
                    <th>Comment By</th>
                    <th>Commnet</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                    @foreach($news->comments as $comment)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$comment->user_id != null ? $comment->user->full_name : 'Anonymous'}}</td>
                            <td>{{$comment->body}}</td>
                            <td>
                                <a href="{{ route('comment.edit', $comment->id)}}" class="btn btn-outline-primary">Edit</a>
                                <form action="{{ route('comment.destroy', $comment->id)}}" onclick="return confirm('Are you sure, you want to delete this Comment?')" method="post" style="display: inline;">
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
