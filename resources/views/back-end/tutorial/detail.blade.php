@extends('back-end.admin-layout')

@section('content')

    <style>
        #add_button{
            float: right;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
    <h2 class="ml-3">Change Product Status</h2>

        <div class="bg-white my-4 mx-1 p-3 shadow-sm">

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$tutorial->status ? 'Active' : 'Inactive'}}</p>
                </div>
            </div>

            <div class="row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Image</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9 col-md-3 " style="box-shadow: 0 0 4px #c5c5c5; padding: 5px;">
                    <img src="{{asset('storage/tutorial/' . $tutorial->tutorial_image)}}" alt="" width="100%">
                </div>
            </div>

            <div class="form-group row mt-2">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$tutorial->name}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Date</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$dateOrganizer->makePrettyDate($tutorial->date)}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Created At</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$dateOrganizer->makePrettyDate($tutorial->created_at)}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Price</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$tutorial->price}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Trainers</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    @foreach(json_decode($tutorial->trainers) as $trainer)
                        <div style="box-shadow: 0 0 4px #c5c5c5; padding: 10px; margin-bottom: 15px;">
                            <p>Name : {{$trainer->name}}</p>
                            <p>Organization : {{$trainer->org}}</p>
                            <p>Designation : {{$trainer->desg}}</p>
                            <p>Description : {{$trainer->desc}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Attendees</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$tutorial->attendees}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$tutorial->description}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Curriculum</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$tutorial->curriculum}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Requirement</label>
                <div class="col-md-1">:</div>
                <div class="col-sm-9">
                    <p>{{$tutorial->requirement}}</p>
                </div>
            </div>


            Email List of attendees :
            <div class="mt-3 mb-3" style="box-shadow: 0 0 3px #c5c5c5; padding: 10px;">
                <p>
                    @foreach($invoices as $invoice)
                        {{$invoice->user->email}},
                    @endforeach
                </p>
            </div>

            {{--attendees list--}}
            @include('back-end.tutorial.datatable')
        </div>




@endsection