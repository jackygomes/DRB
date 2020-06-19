@extends('back-end.admin-layout')

@section('content')
    <style>
        #add_button{
            float: right;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
    <h2>Change Product Status</h2>
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
    @endif
    <form  method="post" action="{{route('admin.research.admin.update', $product->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="bg-white my-4 mx-1 p-3 shadow-sm">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$product->name}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Ticker</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$product->company->ticker}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Provider</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$product->provider}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Category</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$product->category->name}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Date</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{date('d-m-Y', strtotime($product->date))}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Analysts</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{implode(', ', json_decode($product->analysts))}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$product->description}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Price</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$product->price}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <select class="custom-select mr-sm-2" name="status">
                        <option value="Approved" {{$product->status == 'Approved' ? 'selected' : ''}}>Approved</option>
                        <option value="Pending" {{$product->status == 'Pending' ? 'selected' : ''}}>Pending</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Excel File</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    @if(isset($product->report_excel))
                        <a href="/{{$product->report_excel}}" class="btn btn-warning" download>Download</a>
                    @else
                        <p>No File</p>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">PDF File</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    @if(isset($product->report_pdf))
                        <a href="/{{$product->report_pdf}}" class="btn btn-warning" download>Download</a>
                    @else
                        <p>No File</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
                </div>
            </div>
        </div>

    </form>
@section('scripts')

@endsection

@endsection
