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

        <div class="col-md-6 offset-3 col-12 p-4" style="box-shadow: 0 0 4px #c5c5c5;">
            <p class="text-center">Get Your Favorite News First</p>
            <hr>

            <form class="form-horizontal" action="{{route('news.for.you.post')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="sel1">Newspaper :</label>
                    <select class="form-control" id="sel1" name="newspaper">
                        <option value="">Select</option>
                        <option value="1">The Daily Star</option>
                        <option value="2">The New Age</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sel2">Category :</label>
                    <select class="form-control" id="sel2" name="category">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ ($filter->category_id == $category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center">
                    <button class="btn btn-warning" style="color: #fff;" type="submit">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection