<?php $i = 1 ; ?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Category List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Category Name</th>
                    <th>Order</th>
                    <th>Publish</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Sl.</th>
                    <th>Category Name</th>
                    <th>Order</th>
                    <th>Publish</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->order}}</td>
                            <td>
                                @if ( $category->is_published == 0)
                                    No
                                @else
                                    Yes
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $category->id)}}" class="btn btn-outline-primary">Edit</a>
                                <form action="{{ route('category.destroy', $category->id)}}" onclick="return confirm('Are you sure, you want to delete this category?')" method="post" style="display: inline;">
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
    {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
</div>
