@extends('front-end.main-layout')
@section('content')
<div class="container">
  <div class="row success-failure-card-top">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="card my-5 text-center py-5 border border-success">
        <i class="far fa-check-circle fa-4x text-success mb-4"></i>
        <h3 class="display-4 font-weight-bold">Success</h3>
        <div class="card-body">
          <h5 class="card-title">PAYMENT COMPLETE!</h5>
          <p class="card-text">Thank you for your transfer</p>
          <a href="/" class="text-decoration-none text-warning">Back to Home ></a>
        </div>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
@endsection
