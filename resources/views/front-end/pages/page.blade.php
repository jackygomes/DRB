@extends('front-end.main-layout')
@section('content')
<!-- Navigation -->

<section class="financial-statement">
    <div class="container">
        <div class="row h-100">
            <div class="col-12">
                {{--add section--}}
                <div class="financial_top_add mb-3">
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Horizontal unit -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-7889950300474908"
                         data-ad-slot="9066843834"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
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
            {{--add section--}}
            <div class="financial_top_add mb-3">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Horizontal unit -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-7889950300474908"
                     data-ad-slot="9066843834"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>

</section>

@endsection
