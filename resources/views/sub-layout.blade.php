@extends('layout')

@section('sub-content')

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-light fixed-top nav-bg border-bottom mt-md-n4">
    <div class="container">
        <a class="navbar-brand text-white" href="/"><h2>DRB</h2></a>
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown nav-custom-margin-top">
                    <a class="nav-link dropdown-toggle font-weight-bold text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        MACRO
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown nav-custom-margin-top">
                    <a class="nav-link dropdown-toggle font-weight-bold text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        COMMODITY
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown nav-custom-margin-top">
                    <a class="nav-link dropdown-toggle font-weight-bold text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        COMPANY
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown nav-custom-margin-top">
                    <a class="nav-link dropdown-toggle nav-custom-margin-right font-weight-bold text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        MARKET
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-warning my-2 my-sm-0 mx-1" type="submit">Sign Up</button>
                    <button class="btn btn-outline-warning my-2 my-sm-0 text-white mx-1" type="submit">Sign In</button>
                </form>
            </ul>
        </div>
    </div>
</nav>
  

<section class="financial-statement">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-md-12 bg-white my-5 p-5 shadow">
                <h1>Financial Statement</h1>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Company</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Sector</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary">Annually</button>
                    <button type="button" class="btn btn-secondary">Quarterly</button>
                </div>
            </div>
            <div class="col-md-8 text-right border-left border-secondary mb-3">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary">Quarter 1</button>
                    <button type="button" class="btn btn-secondary">Quarter 2</button>
                    <button type="button" class="btn btn-secondary">Quarter 3</button>
                    <button type="button" class="btn btn-secondary">Quarter 4</button>
                </div>
            </div>
            <div class="col-md-12 text-center">
                @include('datatable')
            </div>
        </div>
    </div>
</section>

<section class="footer-main py-5">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-md-3">
                <h1>DRB</h1>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled">
                    <li>Home</li>
                    <li>About</li>
                    <li>Support</li>
                </ul>
            </div>
            <div class="col-md-6">
                <label>Stay Updated</label>
                <div class="input-group">
                    <input type="email" class="form-control rounded-0" placeholder="Enter your email">
                    <span class="input-group-btn">
                    <button class="btn btn-warning rounded-0" type="submit">Subscribe</button>
                    </span>
                </div>
            </div>
            <div class="col-md-12 border-top border-light mt-5">
                <div class="text-center mt-5 w-100">
                    <span>Copyright © Data Resources BD 2019</span>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection