<?php $i = 1 ; ?>
<div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Page List</div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Page Title</th>
                    <th>Menu</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Sl.</th>
                    <th>Page Title</th>
                    <th>Menu</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $page->title }}</td>
                        <td>
                            @if($page->menu)
                                {{ $page->menu->title }}
                             @else
                                N/A
                             @endif
                        </td>
                        <td>
                            @if ($page->description != null)
                                {{ $page->description }}
                            @else
                               N/A
                            @endif
                        </td>
                        <td>{{ $page->slug }}</td>
                        <td>
                            <a href="{{ route('page.show', $page->id)}}" class="btn btn-outline-primary">Show</a>
                            <a href="{{ route('page.edit', $page->id)}}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('page.destroy', $page->id)}}" onclick="return confirm('Are you sure, you want to delete this menu?')" method="post" style="display: inline;">
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
