@extends('front-end.main-layout')
@section('content')
    <section class="news" style="margin-top: 120px">
        <div class="container-fluid">
            @include('front-end.newsletter.sidebar')
            <div class="row mt-2">
                <div class="col-12 col-md-9 offset-md-2 single-news-border">
                    <iframe id="newsletter" width="100%" scrolling="no" srcdoc="{{json_decode($newsletter->newsletter_content)->data}}" frameborder="0"></iframe>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-9 offset-md-2 subscribe">
                <div class="col-12 col-md-6 offset-md-3 subscribe_form">
                    <div style="color: #101c53;">
                        <h1 class="text-center">Subscribe to DRB Newsletters</h1>
                    </div>
                    <form action="{{route('subscribe')}}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="form-control rounded-left" name="email" placeholder="Enter your email">
                            <span class="input-group-btn">
                    <button class="btn btn-warning" style="border-radius: 0 3px 3px 0;" type="submit">Subscribe</button>
                </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
        var iframe = document.getElementById("newsletter");
            iframe.onload = function(){
                iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
            }
        });
    </script>
@endsection

@section('styles')
    <style>
        .header_details h4{
            padding-top: 0;
            color: inherit;
            padding-bottom: 0;
            font-family: inherit;
            font-size: 1.5rem;
        }

        .header_details h5{
            color: inherit;
            padding-bottom: 0;
            font-family: inherit;
            font-size: 1.4rem;
            padding-top: 0;
        }

        .type_style{
            background: #101c53;
            border-radius: 3px;
            padding: 0px 10px;
            text-transform: capitalize;
            color: #ffc107 !important;
            display: inline-block;
            font-size: 16px !important;
            margin-top: 20px;
            margin-bottom: 25px;
        }
        .sidebar_margin_top_index_page{
            margin-top: 97px;
        }

        .components li {
            color: #343a40!important;
            font-size: inherit !important;
            font-family: inherit !important;
        }

        @media only screen and (max-width: 768px) {
            .sidebar_margin_top_index_page{
                margin-top: 175px;
            }
        }
    </style>
@endsection