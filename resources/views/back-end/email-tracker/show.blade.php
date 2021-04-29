@extends('back-end.admin-layout')

@section('content')
        <div class="global-box-shadow">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row mt-3">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-md-right"><b>Title:</b> </label>
                        <div class="col-sm-8">
                            <label for="staticEmail" class="col-form-label">{{$emailTracker->title}} </label>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-md-right"><b>Audience:</b> </label>
                        <div class="col-sm-8">
                            <label for="staticEmail" class="col-form-label">{{$emailTracker->num_of_audience}} </label>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-md-right"><b>Created At:</b> </label>
                        <div class="col-sm-8">
                            <label for="staticEmail" class="col-form-label">
                                {{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $emailTracker->created_at)->addHours(6)->format('d M y h:i A')}}
                            </label>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group row mt-3">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-md-right"><b>Opened:</b> </label>
                        <div class="col-sm-8">
                            <label for="staticEmail" class="col-form-label">{{count($emailTracker->audiences)}}</label>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-md-right"><b>Open Ratio:</b> </label>
                        <div class="col-sm-8">
                            <label for="staticEmail" class="col-form-label">
                                {{intval((count($emailTracker->audiences) / $emailTracker->num_of_audience) * 100)}}%
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: -15px;">
                <div class="col-md-12">
                    <div class="form-group row mt-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label text-md-right"><b>Tacking Url:</b> </label>
                        <div class="col-sm-10">
                            <label for="staticEmail" class="col-form-label">
                                &lt;img src="{{route("email.tracker.action", [$emailTracker->uid, "#e-mail#", "#name#"])}}"&gt;
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            @include('back-end.email-tracker.audience-datatable')
        </div>

@endsection
