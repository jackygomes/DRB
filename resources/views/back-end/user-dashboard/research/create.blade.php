@extends('back-end.admin-layout')

@section('content')
<style>
    #add_button{
        float: right;
        cursor: pointer;
        text-decoration: underline;
    }
</style>
<h2>Upload Research</h2>
@if($message = Session::get('success'))
    <div class="alert alert-success">
        {{$message}}
    </div>
@endif
<form  method="post" action="{{route('research.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" type="text" placeholder="Enter Name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Ticker</label>
                    <select class="custom-select mr-sm-2" name="ticker_id">
                        <option selected>Choose Ticker...</option>
                        @foreach($tickers as $ticker)
                            <option value="{{$ticker->id}}">{{ $ticker->ticker }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Provider</label>
                    <input class="form-control" name="provider" type="text" placeholder="Enter Provider Name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Category</label>
                    <select class="custom-select mr-sm-2" name="category_id">
                        <option selected>Choose Category...</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Date</label>
                    <input class="form-control" name="date" type="date">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Analysts</label>
                    <div class="analyst-input">
                        <input class="form-control mt-1" name="analysts[]" type="text" placeholder="Enter Analyst Name">
                    </div>
                    <a id="add_button" class="text-primary mt-md-2">Add More Analyst</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" placeholder="Description (Max 250 words)" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label>Price</label>
                    <input id="price" class="form-control" name="price" placeholder="Enter Price">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Upload Excel File</label>
                    <input type="file" name="excelFile" class="form-control-file">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Upload PDF File</label>
                    <input type="file" name="pdfFile" class="form-control-file">
                </div>
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
    <script type="application/javascript">
        $(document).ready(function(){
            $('#add_button').click(function(e) {
                e.preventDefault();
                $('.analyst-input').append('<input class="form-control mt-1" name="analysts[]" type="text" placeholder="Add Another Analyst Name">'); //add input box
            });

            $("#price").keydown(function (event) {
                if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) {
                } else {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection

@endsection
