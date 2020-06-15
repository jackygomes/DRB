<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use App\ResearchCategory;
use App\Sector;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('company')->with('sector')->with('category')->get();
        return $products;
        return view('back-end.user-dashboard.research.index');
    }

    public function researchAdmin() {
        $userId = Auth::id();
        $user_info = User::where('id', '=', $userId)->first();

        if($user_info->type == 'admin'){
        } else {
            return abort(404);
        }

        $products = DB::select("
                select p.* , c.ticker as ticker_name, s.name as sector_name, cat.name as category_name
                from products as p
                JOIN companies as c ON c.id = p.ticker_id
                JOIN sectors as s ON s.id = p.sector_id
                JOIN research_categories as cat ON cat.id = p.category_id
            ");

        return view('back-end.user-dashboard.research.index', compact('products'));
    }

    public function researchUser() {
        $userId = Auth::id();
        $user_info = User::where('id', '=', $userId)->first();

        if($user_info->type == 'provider'){
        } else {
            return abort(404);
        }

        $products = Product::where('user_id', $userId)->with('company')->with('sector')->with('category')->get();

//        return $products;

        return view('back-end.user-dashboard.research.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = Sector::all();
        $tickers = Company::all();
        $categories = ResearchCategory::all();
        return view('back-end.user-dashboard.research.create', compact('sectors', 'tickers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $this->validate($request, [
            'name'  =>  'required',
            'ticker_id'  =>  'required',
            'provider'  =>  'required',
            'category_id'  =>  'required',
            'date'  =>  'required',
            'analysts'  =>  'required',
            'price'  =>  'required',
            'excelFile' => 'file|mimes:xlsx,xlsm,xlsb,xltx,xltm,xls,xlt,xml,xlam.xla,xlw,xlr,csv',
            'pdfFile' => 'file|mimes:pdf',
        ]);
        $randomText = Str::random(4);
        $slug = Str::slug($request->input('name'), '-');
        $slug = $slug.'-'.$randomText;

        $analystNames = [];
        for($x = 0; $x < count($request->analysts); $x++) {
            if($request->input('analysts.'.$x) != null){
                array_push($analystNames, $request->input('analysts.'.$x));
            }
        }

        $analystNames = json_encode($analystNames);

        $ticker = Company::where('id', '=', $request->ticker_id)->first();

        $excelFile = $request->file('excelFile');
        $excelFileName = '';
        if($excelFile) {
            $excelFileNameOriginal = explode('.', $excelFile->getClientOriginalName());
            $excelFileName = $excelFileNameOriginal[0].'-'.time().'.'.$excelFile->getClientOriginalExtension();
            $excelFile->move(public_path("img/files"), $excelFileName);
        }

        $pdfFile = $request->file('pdfFile');
        $pdfFileName = '';
        if($pdfFile) {
            $pdfFileNameOriginal = explode('.', $pdfFile->getClientOriginalName());
            $pdfFileName = $pdfFileNameOriginal[0].'-'.time().'.'.$pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path("img/files"), $pdfFileName);
        }

        try{
            $product = [
                'name'          => $request->name,
                'slug'          => $slug,
                'user_id'       => $userId,
                'ticker_id'     => $request->ticker_id,
                'sector_id'     => $ticker->sector_id,
                'provider'      => $request->provider,
                'category_id'   => $request->category_id,
                'date'          => $request->date,
                'analysts'      => $analystNames,
                'description'   => $request->description,
                'report_excel'  => $excelFileName ? $excelFileName : null,
                'report_pdf'    => $pdfFileName ? $pdfFileName : null,
                'price'         => $request->price,
            ];
            Product::create($product);

        } catch(\Exception $e) {
            return "Quiz insertion error: " . $e->getMessage();
        }

//        $sectors = Sector::all();
//        $tickers = Company::all();
//        $categories = ResearchCategory::all();
//        return view('back-end.user-dashboard.research.create', compact('sectors', 'tickers', 'categories'))
//            ->with('success','Successfully uploaded');
        return redirect()->route('research.create')->with('success', 'Successfully Uploaded');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
