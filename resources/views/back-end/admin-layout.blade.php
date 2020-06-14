@extends('layout')

@section('admin-content')

<div class="wrapper">

    @include('back-end.partial.sidenav')

    <!-- Page Content  -->
    <div id="content">

        @include('back-end.partial.topnav')
        @if(count($errors) > 0 )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="p-0 m-0" style="list-style: none;">
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('error'))
            <div class="row text-center alert alert-danger push-down">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    {{session('error')}}
                </div>
                <div class="col-md-4"></div>
            </div>
        @endif
        <div id="content-wrapper">

            <div class="container-fluid">

              @include('breadcrumb')
              @yield('content')

              {{-- @include('page') --}}

            </div>
            <!-- /.container-fluid -->

            @include('back-end.footer')

        </div>
        <!-- /.content-wrapper -->
    </div>
</div>

@endsection
