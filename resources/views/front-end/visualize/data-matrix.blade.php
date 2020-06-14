@extends('front-end.main-layout')
@section('content')

<!-- Navigation -->
<section class="financial-statement" id="mainApp">

<div class="col-md-12 mt-5">
    <h3>Data Matrix</h3>
</div>
    <div class="container-fluid h-100 ">
        @include('front-end.visualize/company-datatable')
    </div>
</section>
@endsection