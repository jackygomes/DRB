<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="DRB">
    <meta name="author" content="Techynaf">

    <title>Data Resources BD</title>

    <!-- Font Awesome -->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Owl CSS -->
    <link href="/vendor/owl/owl.carousel.min.css" rel="stylesheet">

    <!-- Data Tables CSS -->
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.dataTables.min.css">

    <!-- Custom styles -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="/img/favicon.png">


    @yield('styles')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145375324-8"></script>

    {{--Google Ads--}}
    <script data-ad-client="ca-pub-7889950300474908" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    {{--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dce8059e10469a8" async="async"></script>--}}
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-145375324-8');
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-165851846-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-165851846-1');
    </script>

    @yield('meta')

</head>

<body id="page-top">
    <div class="se-pre-con"></div>

    @yield('main-content')
    @yield('sub-content')
    @yield('admin-content')


    <!-- Scroll to Top Button-->
    <button class="rounded-pill" onclick="topFunction()" id="scroll-to-top" title="Go to top">
        <i class="fas fa-angle-up"></i>
    </button>

    <!-- JQuery and Bootstrap -->
    @if(\Request::path() != 'visualize/data-matrix')
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    @endif
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- JQuery Easing -->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Owl -->
    <script src="{{asset('vendor/owl/owl.carousel.min.js')}}"></script>

    <!-- Plugin JavaScripts -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>

    <!-- Custom scripts -->
    <script src="{{asset('js/script.js')}}"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
     {{--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dce8059e10469a8" async="async"></script>--}}
    {{--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=[YOUR PROFILE ID]" async="async"></script>--}}
    {{--<script type="text/javascript" src="{{asset('js/addthis_widget.js#pubid=ra-5dce8059e10469a8&async=1')}}" ></script>--}}

    <script>
    $(window).scroll(function() {
        sessionStorage.scrollTop = $(this).scrollTop();
    });

    $(document).ready(function() {
    if (sessionStorage.scrollTop != "undefined") {
        $(window).scrollTop(2);
    }
    });
    </script>
    @yield('scripts')


    <script>
        $(window).on('load', function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
    @yield('scripts2')
</body>


</html>
