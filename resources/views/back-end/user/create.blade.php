@extends('back-end.admin-layout')

@section('content')

    <div class="container">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                {{$message}}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create user</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="full_name" required autocomplete="name" autofocus>

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
                                    <input id="contact_number" type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                                <div class="col-md-6">
                                    <input id="profession" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="institution" class="col-md-4 col-form-label text-md-right">{{ __('Institution') }}</label>

                                <div class="col-md-6">
                                    <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="institution" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}*</label>

                                <div class="col-md-6">
                                    <select class="custom-select" name="type" id="role">
                                            <option value="visitor">Visitor</option>
                                            <option value="paid">Paid</option>
                                            <option value="provider">Provider</option>
                                            <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}*</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
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
                                        <input type="file" name="thumbnailImage" class="form-control-file" id="thumbnail_image">
                                        <p style="margin: 5px 0 0; font-size: 14px; color: #721c24">* Thumbnail image ratio should be square.</p>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-warning">
                                        Submit
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
