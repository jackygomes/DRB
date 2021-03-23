@extends('back-end.admin-layout')

@section('content')
    <?php $i = 1 ?>
    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-table"></i> Purchased Research List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Ticker</th>
                        <th>Sector</th>
                        <th>Provider</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Analysts</th>
                        <th>Description</th>
                        <th>Excel File</th>
                        <th>PDF File</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Ticker</th>
                        <th>Sector</th>
                        <th>Provider</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Analysts</th>
                        <th>Description</th>
                        <th>Excel File</th>
                        <th>PDF File</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->company->ticker}}</td>
                            <td>{{$product->sector->name}}</td>
                            <td>{{$product->provider}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->date}}</td>
                            <td>
                                {{implode(', ', json_decode($product->analysts))}}
                            </td>
                            <td>{{Str::limit($product->description, 30)}}</td>
                            <td>
                                @if(isset($product->report_excel))
                                    <a href="{{asset('/files/' . $product->report_excel)}}" class="btn btn-warning" download>Download</a>
                                @else
                                    <p>No File</p>
                                @endif
                            </td>
                            <td>
                                @if(isset($product->report_pdf))
                                    <a href="{{asset('/files/' . $product->report_pdf)}}" class="btn btn-warning" download>Download</a>
                                @else
                                    <p>No File</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if(count($products) == 0)
                        <h5 class="text-center text-muted">No Purchased Item To Show</h5>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>


@endsection
