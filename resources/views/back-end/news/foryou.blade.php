@extends('back-end.admin-layout')

@section('content')
        <div class="row">
            @if(Session::has('success'))
            <div class="col-md-6 offset-3 col-12">
                <div class="alert alert-success text-center">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-sm-12 p-4" style="box-shadow: 0 0 4px #c5c5c5;">
            <p class="text-center">Get Your Favorite News</p>
            <hr>

            <form class="form-horizontal" action="{{route('news.for.you.post')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <p class="mb-0">Languages:</p>
                            <div class="form-check form-check-inline filter_item_design {{($filter && $filter->language == 'english') ? 'filter_item_design_background' : ''}}" style="padding-left: 10px">
                                <input {{($filter && $filter->language == 'english') ? 'checked' : ''}} class="form-check-input" type="radio" name="language" id="inlineRadio1" value="english">
                                <label class="form-check-label" for="inlineRadio1">English</label>
                            </div>
                            <div class="form-check form-check-inline filter_item_design {{($filter &&$filter->language == 'bangla') ? 'filter_item_design_background' : ''}} " style="padding-left: 10px">
                                <input {{($filter &&$filter->language == 'bangla') ? 'checked' : ''}} class="form-check-input" type="radio" name="language" id="inlineRadio2" value="bangla">
                                <label class="form-check-label" for="inlineRadio2">Bangla</label>
                            </div>

                            <div class="form-check form-check-inline filter_item_design {{($filter && $filter->language == 'both') ? 'filter_item_design_background' : ''}}" style="padding-left: 10px">
                                <input {{($filter && $filter->language == 'both') ? 'checked' : ''}} class="form-check-input" type="radio" name="language" id="inlineRadio2" value="both">
                                <label class="form-check-label" for="inlineRadio2">Both</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="mb-0">Newspapers :</p>
                            @foreach($newspapers as $newspaper)
                                <div class="form-check d-inline-block filter_item_design
                                                        @if($filter && $filter->newspaper_id)
                                {{(in_array($newspaper->id, json_decode($filter->newspaper_id))) ? 'filter_item_design_background' : ''}}
                                @endif
                                        ">
                                    <input
                                            class="form-check-input position-static"
                                            type="checkbox"
                                            value="{{$newspaper->id}}"
                                            name="newspapers[]"
                                    @if($filter && $filter->newspaper_id)
                                        {{(in_array($newspaper->id, json_decode($filter->newspaper_id))) ? 'checked' : ''}}
                                            @endif
                                    >
                                    <label class="form-check-label d-inline">{{$newspaper->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="mb-0">Categories :</p>
                            @foreach($categories as $category)
                                <div class="form-check d-inline-block filter_item_design
                                                @if($filter && $filter->category_id)
                                {{(in_array($category->id, json_decode($filter->category_id))) ? 'filter_item_design_background' : ''}}
                                @endif

                                        ">
                                    <input
                                            class="form-check-input position-static"
                                            type="checkbox"
                                            value="{{$category->id}}"
                                            name="categories[]"
                                    @if($filter && $filter->category_id)
                                        {{(in_array($category->id, json_decode($filter->category_id))) ? 'checked' : ''}}
                                            @endif
                                    >
                                    <label class="form-check-label d-inline">{{$category->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>




                <div class="">
                    <button class="btn btn-warning" style="color: #fff;" type="submit">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function(){
            $("input").click(function (event) {
                $(event.target).closest('div').addClass('filter_item_design_background')
            })
        })

    </script>
@endsection