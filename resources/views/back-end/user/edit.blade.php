@extends('back-end.admin-layout')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('User Update') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="full_name" value="{{ $user->full_name }}" required autocomplete="name" autofocus>

                                    @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                                <div class="col-md-6">
                                    <input id="contact_number" type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ $user->contact_number }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                                <div class="col-md-6">
                                    <input id="profession" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" value="{{ $user->profession }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="institution" class="col-md-4 col-form-label text-md-right">{{ __('Institution') }}</label>

                                <div class="col-md-6">
                                    <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" value="{{ $user->institution }}" required autocomplete="name" autofocus>
                                </div>
                            </div>
                            @if(auth()->user()->type == 'admin')
                                <div class="form-group row">
                                    <label for="institution" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                    <div class="col-md-6">
                                        <select class="custom-select" name="type" id="role">
                                                <option value="admin">Admin</option>
                                                <option value="paid">Paid</option>
                                                <option value="visitor">Visitor</option>
                                                <option value="provider">Provider</option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            @if(auth()->user()->type == 'admin' && $user->type != 'paid')
                                <div class="form-group row">
                                    <label for="institution" class="col-md-4 col-form-label text-md-right">Package</label>
                                    <div class="col-md-6">
                                        <select class="custom-select" name="plan" id="plan">
                                            <option value="">Select Package</option>
                                            @foreach($plans as  $plan)
                                                <option value="{{$plan->id}}" >{{$plan->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="thumbnailImage">
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Thumbnail Image</label>

                                    <div class="col-md-6">
                                        @if(isset($user->thumbnail_image))
                                        <img class="img-thumbnail" src="{{asset('storage/'.$user->thumbnail_image)}}" alt=""/>
                                        @else
                                        <label for="password" class="col-md-4 col-form-label">No Image</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Update Thumbnail Image</label>

                                    <div class="col-md-6">
                                        <input type="hidden" name="oldThumbnailImage" value="{{$user->thumbnail_image}}" class="form-control-file" id="thumbnail_image">
                                        <input type="file" name="thumbnailImage" class="form-control-file" id="thumbnail_image">
                                        <p style="margin: 5px 0 0; font-size: 14px; color: #721c24">* Thumbnail image ratio should be square.</p>
                                        </span>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-warning">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script type="application/javascript">
        $('#thumbnailImage').hide();
        if($("#role").val() == "provider"){
            $('#thumbnailImage').show();
        }
        $( "#role" ).change(function() {
            if($(this).val() == "provider"){
                $('#thumbnailImage').show();
            } else {
                $('#thumbnailImage').hide();
            }
        });
    </script>
@endsection
@endsection
