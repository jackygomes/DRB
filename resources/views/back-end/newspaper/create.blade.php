@extends('back-end.admin-layout')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-3 col-12 p-4" style="box-shadow: 0 0 4px #c5c5c5;">
            <form class="form-horizontal" action="{{route('newspapers.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Add Newspaper</label>
                    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Newspaper Name" name="newspaper">
                </div>

                <div class="text-center">
                    <button class="btn btn-warning" style="color: #fff;" type="submit">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection