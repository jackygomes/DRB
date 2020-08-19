@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('company.update', $company->id) }}">
    @csrf
    @method('patch')
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-3">
            <div class="form-group">
            <label>Company Name</label>
            <input class="form-control" name="name"  value="{{ $company->name }}" type="text" placeholder="Enter Company Name">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <label>Ticker </label>
            <input class="form-control" name="ticker"  value="{{ $company->ticker }}" type="text" placeholder="Enter Ticker">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <label>Visibility</label>
                <select class="form-control" name="is_visible">
                    @if($company->is_visible)
                    <option value="1" >Show</option>
                    <option value="0">Hide</option>
                    @else
                        <option value="0">Hide</option>
                        <option value="1" >Show</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group ">
                <label>Sector:<span class="text-danger">*</span> </label>
                <select class="form-control dropdown-custom" name="sector_id" require>
                    @foreach($sectors as $sector)
                        @if (($company->sector->id) == $sector->id))
                            <option value="{{$sector->id}}" selected>{{$sector->name}}</option>
                        @else
                            <option value="{{$sector->id}}">{{$sector->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
        </div>
    </div>
</form>

@endsection
