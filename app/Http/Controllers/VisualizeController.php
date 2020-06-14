<?php

namespace App\Http\Controllers;

use App\Sector;
use App\StockInfo;
use Illuminate\Http\Request;
use App\Service\DSE;

class VisualizeController extends Controller
{
    public function index(){
        return view('front-end.visualize.index');
    }

    public function dataMatrix(){
        DSE::fetch();
        $sectors = Sector::all();
        return view('front-end.visualize.data-matrix', compact('sectors'));
    }
}
