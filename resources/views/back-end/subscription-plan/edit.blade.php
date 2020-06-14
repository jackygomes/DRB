@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('subscriptionplan.update', $subscriptionplan->id) }}">
    @csrf
    @method('patch')
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
            <div class="col-md-2">
                <div class="form-group">
                <label>Plan Name</label>
                <input class="form-control" name="name"  value="{{ $subscriptionplan->name }}" type="text" placeholder="Enter Plan Name">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                <label>Price Per Month </label>
                <input class="form-control" name="price_per_month"  value="{{ $subscriptionplan->price_per_month }}" type="number" placeholder="Enter Monthly Price">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                <label>Price Per Year</label>
                <input class="form-control" name="price_per_year"  value="{{ $subscriptionplan->price_per_year }}" type="number" placeholder="Enter yearly Price">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                <label>User Limit</label>
                <input class="form-control" name="user_limit"  value="{{ $subscriptionplan->user_limit }}" type="number" placeholder="Enter User Limit">
                </div>
            </div>

            <div class="col-md-2 text-md-center ml-4 ml-md-0 sub-plan-check-top">
                <input class="form-check-input" type="checkbox" name="is_visible" value=1 id="defaultCheck1" {{$subscriptionplan->is_visible == 1 ?'checked':''}}>
                <label class="form-check-label h5" for="defaultCheck1">
                    Visible
                </label>
            </div>
        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
        </div>
    </div>
</form>

@endsection
