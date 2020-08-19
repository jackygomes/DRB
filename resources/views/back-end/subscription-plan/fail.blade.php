@extends('front-end.main-layout')
@section('content')
<div class="container">
  <div class="row success-failure-card-top">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="card my-5 text-center py-5 border border-danger">
        <i class="far fa-times-circle fa-4x text-danger mb-4"></i>
        <h3 class="display-4 font-weight-bold">Failure</h3>
        <div class="card-body">
          <h5 class="card-title">PAYMENT INCOMPLETE!</h5>
          <p class="card-text">Please try again</p>
          <a href="/" class="text-decoration-none text-warning">Back to Home ></a>
        </div>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
@endsection
