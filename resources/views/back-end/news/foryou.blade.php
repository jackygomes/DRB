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

        <div class="col-md-6 offset-3 col-12 p-4" style="box-shadow: 0 0 4px #c5c5c5;">
            <p class="text-center">Get Your Favorite News</p>
            <hr>

            <form class="form-horizontal" action="{{route('news.for.you.post')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sel1">Newspapers :</label>
                                @foreach($newspapers as $newspaper)
                                    <div class="form-check">
                                        <input
                                                class="form-check-input position-static"
                                                type="checkbox"
                                                value="{{$newspaper->id}}"
                                                name="newspapers[]"
                                                @if($filter && $filter->newspapers)
                                                    {{(in_array($newspaper->id, json_decode($filter->newspapers))) ? 'checked' : ''}}
                                                @endif
                                        >
                                        <label class="form-check-label">{{$newspaper->name}}</label>
                                    </div>
                                @endforeach
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sel2">Categories :</label>
                                @foreach($categories as $category)
                                    <div class="form-check">
                                        <input
                                                class="form-check-input position-static"
                                                type="checkbox"
                                                value="{{$category->id}}"
                                                name="categories[]"
                                                @if($filter && $filter->categories)
                                                    {{(in_array($category->id, json_decode($filter->categories))) ? 'checked' : ''}}
                                                @endif
                                        >
                                        <label class="form-check-label">{{$category->name}}</label>
                                    </div>
                                @endforeach
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <label>Select Language:<span class="text-danger">*</span> </label>
                            <select class="form-control dropdown-custom" name="language" require>
                                <option value="english" {{($filter && $filter->language == 'english') ? 'selected' : ''}}>English</option>
                                <option value="bangla" {{($filter &&$filter->language == 'bangla') ? 'selected' : ''}}>Bangla</option>
                                <option value="both" {{($filter && $filter->language == 'both') ? 'selected' : ''}}>Both</option>
                            </select>
                        </div>
                    </div>
                </div>




                <div class="text-center">
                    <button class="btn btn-warning" style="color: #fff;" type="submit">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection