@extends('back-end.admin-layout')

@section('content')
    <div class="text-right mb-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="{{route('nl_category.update', $newsletterCategories->id)}}" class="mt-3">
                            <div class="row">
                                @csrf
                                <div class="col-md-8 text-right">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-md-4 col-form-label">Newsletter Category:</label>
                                        <div class="col-md-8">
                                            <input name="category" type="text" class="form-control" value="{{$newsletterCategories->category}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 text-right">
                                    <button class="btn btn-primary d-inline" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection