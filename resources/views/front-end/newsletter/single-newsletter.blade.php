@extends('front-end.main-layout')
@section('content')
    <section class="news" style="margin-top: 120px">
        <div class="container-fluid">
            <div class="row">
                @include('front-end.newsletter.sidebar')
                <div class="col-12 col-md-9 offset-md-2 single-news-border">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('/storage/newsletter_thumbnail/' . $newsletter->thumbnail)}}" alt="" width="100%" style="border-radius: 5px;">
                        </div>

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="header_details" style="width: 100%">
                                <h4>{{$newsletter->title}}</h4>
                                <p class="type_style">{{ucfirst($newsletter->category->type)}}</p>
                                <h5>{{$newsletter->readable_publishing_date}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12 col-md-9 offset-md-2 single-news-border">
                    {!! json_decode($newsletter->newsletter_content)->data !!}
                </div>
            </div>
        </div>
    </section>
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