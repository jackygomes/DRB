@extends('front-end.main-layout')
@section('content')
    <section class="news" style="margin-top: 120px">
        <div class="container-fluid">
            <div class="row">
                @include('front-end.newsletter.sidebar')
                <div class="col-md-8 offset-3 single-news-border">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('/storage/newsletter_thumbnail/' . $newsletter->thumbnail)}}" alt="" width="100%" style="border-radius: 5px;">
                        </div>

                        <div class="col-md-8 d-flex align-items-center text-right">
                            <div style="width: 100%">
                                <h4>{{$newsletter->title}}</h4>
                                <h5>{{$newsletter->readable_publishing_date}}</h5>
                                <h5 class="type_style">{{ucfirst($newsletter->type)}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-8 offset-3 single-news-border">
                    {!! json_decode($newsletter->newsletter_content)->data !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .type_style{
            background: #101c53;
            border-radius: 3px;
            padding: 0px 10px;
            text-transform: capitalize;
            color: #ffc107 !important;
            display: inline-block;
        }
    </style>
@endsection