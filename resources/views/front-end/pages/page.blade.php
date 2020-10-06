@extends('front-end.main-layout')
@section('content')
<!-- Navigation -->

<section class="financial-statement">
    <div class="container">
        <div class="row h-100">
            <div class="col-12">
                <div class="financial_top_add mb-3">
                    <p>Add</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if($page)
            <h3>{{$page->title}} </h3>
            <p>{{$page->description}} </p>
            <div class="row align-items-center h-100">
                <div class="col-md-12 text-center">
                    @include('front-end.pages.datatable')

                </div>
            </div>
        @else
            <h3 class="text-center mb-5">No Data Available </h3>
        @endif
    </div>

    <div class="row">
        <div class="col-12">
            <div class="financial_top_add mb-3">
                <p>Add</p>
            </div>
        </div>
    </div>

</section>

@endsection
