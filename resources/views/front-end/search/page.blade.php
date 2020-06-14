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
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Sl.</th>
                    <th>Page Title</th>
                    <th>Menu</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $page->title }}</td>
                        @if($page->menu)
                            <td>{{ $page->menu->title }}</td>
                        @endif
                        <td>{{ $page->description }}</td>
                        <td><a href="{{ $page->slug }}" class="btn btn-outline-primary">Show</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
