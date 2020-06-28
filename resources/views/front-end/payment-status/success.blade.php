@extends('front-end.main-layout')
@section('content')
    <!-- Navigation -->

    <section class="financial-statement">
        <div class="container-fluid">
            @if($status == 'success')
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>
                            Payment Successful</h1>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p class="text-center">You can now download your product from your account.</p>
                    </div>
                </div>
            @elseif($status == 'failed')
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center text-danger"><i class="fa fa-check-circle" aria-hidden="true"></i>
                            Payment Failed</h1>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p class="text-center">Something went wrong with your payment.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection
