@extends('back-end.admin-layout')

@section('content')

<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
    <div class="card">
        <div class="card-header p-4">
            <a class="pt-2 d-inline-block main-text-color" href="#" data-abc="true"><h2>DRB</h2></a>
            <div class="float-right">
                <h4 class="mb-0">Invoice #BBB10234</h4>
                Date: 19 Feb,2020
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h5 class="mb-3">From:</h5>
                    <h4 class="text-dark mb-1">Data Resoources BD</h4>
                    <div>29, Uttara</div>
                    <div>Dhaka-1209</div>
                    <div>Email: contact@drb.com</div>
                    <div>Phone: +88 017 55 837774</div>
                </div>
                <div class="col-sm-6 ">
                    <h5 class="mb-3">To:</h5>
                    <h4 class="text-dark mb-1">Client Name</h4>
                    <div>29, Uttara</div>
                    <div>Dhaka-1209</div>
                    <div>Email: contact@drb.com</div>
                    <div>Phone: +88 017 55 837774</div>
                </div>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">Sl.</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th class="right">Price</th>
                            <th class="center">Qty</th>
                            <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center">1</td>
                            <td class="left strong">Basic</td>
                            <td class="left">Basic Package for 5 user</td>
                            <td class="right">bdt 500</td>
                            <td class="center">1</td>
                            <td class="right">bdt 500</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                </div>
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Total</strong> </td>
                                <td class="right">
                                    <strong class="text-dark">bdt 500</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <p class="mb-0">Thanks for purchase. DRB</p>
        </div>
    </div>
</div>

@endsection