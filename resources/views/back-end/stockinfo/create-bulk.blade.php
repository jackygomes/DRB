@extends('back-end.admin-layout')
@section('content')
<div class="container-fluid">
  <div class="row mt-n4 mt-md-5 mb-2 header-panel-all">
    <div class="col-12 my-auto text-center text-sm-left">
      <h5 class="ml-n3">Bulk StockInfo Update</h5>
    </div>
  </div>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Bulk StockInfo Update</a></li>
    </ol>
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="alert alert-info alert-dismissible fade show">
        <h6>Dear {{auth()->user()->full_name}}, <br>To update stockinfos in bulk please follow the following steps:</h6>
        <ul class="remove-bullet">
          <li>
            <b>1.</b> Create a CSV file with the information in mentioned in the example file.
          </li>
          <li><b>2.</b> Company Name should be properly matched with our database</li>
          <li><b>3.</b> Click on the "Choose File" button and browse and add the CSV file.</li>
          <li><b>4.</b> After adding the CSV file click on the "Submit" button to upload the file.</li>
        </ul>
        <b>** For downloading example CSV file click on the "Download Example File" link under the "Submit" button.</b>
      </div>
    </div>
    <div class="col-md-6">
      <form action="{{ route('stockinfo.store-bulk') }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-md-8 border border-secondary p-2">
              <input type="file" name ="file" class="form-control-file" id="exampleFormControlFile1" required>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary rounded-0 w-100 py-2">Submit</button>
            </div>
          </div>
      </form>
      <div class="row">
        <div class="col-md-12 text-right">
          <a class="alert-primary" href="/example/stockinfos.csv" >Download Example File</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script src="/js/dropzone.js"></script>

  <script type="text/javascript">
    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        acceptedFiles: ".csv",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response)
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
    };
  </script>
@endsection


@section('styles')
  <link rel="stylesheet" href="/css/dropzone.css">
@endsection
