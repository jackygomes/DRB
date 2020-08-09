<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Company;
use App\Order;
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
    public function index(Request $request)
    {

        $userId = Auth::id();
        $companies = Company::get();

        $products = Product::where('status', 'Approved')->with('user')->with('company')->with('sector')->with('category')->orderBy('created_at', 'DESC');
        $cart = Cart::where('user_id', $userId)->with('cartItems')->first();
        $productForProviderNames = Product::where('status', 'Approved')->get();
        $researchCategories = ResearchCategory::all();

        if(isset($request->analyst_name)) {
            $products = $products->where('analysts', 'Like', '%'.$request->analyst_name.'%');
        }
        if(isset($request->provider)) {
            $products = $products->where('provider', 'Like', '%'.$request->provider.'%');
        }
        if(isset($request->company_id)){
            $products = $products->where('ticker_id', $request->company_id);
        }
        if(isset($request->category_id)){
            $products = $products->where('category_id', $request->category_id);
        }
        $products = $products->get();

        $providerNames = [];
        foreach($productForProviderNames as $product) {
            if (!in_array($product->provider, $providerNames)){
                array_push($providerNames, $product->provider);
            }
        }

        return view('front-end.research.research', compact('researchCategories','products','companies','cart','providerNames'));
    }

    /**
     * Show all product in admin account
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function researchAdmin() {
        $userId = Auth::id();
        $user_info = User::where('id', '=', $userId)->first();

        if($user_info->type == 'admin'){
        } else {
            return abort(404);
        }

        $products = Product::with('company')->with('sector')->with('category')->orderBy('created_at', 'DESC')->get();

//        return $products;
        return view('back-end.user-dashboard.research.index', compact('products'));
    }

    /**
     * Show user's own uploaded product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function researchUser() {
        $userId = Auth::id();
        $user_info = User::where('id', '=', $userId)->first();

        if($user_info->type == 'provider'){
        } else {
            return abort(404);
        }

        $products = Product::where('user_id', $userId)->with('company')->with('sector')->with('category')->get();

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
            $excelFile->move(public_path("files"), $excelFileName);
        }

        $pdfFile = $request->file('pdfFile');
        $pdfFileName = '';
        if($pdfFile) {
            $pdfFileNameOriginal = explode('.', $pdfFile->getClientOriginalName());
            $pdfFileName = $pdfFileNameOriginal[0].'-'.time().'.'.$pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path("files"), $pdfFileName);
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
     * admin research edit for aprrove
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminEdit($productId) {
        $product = Product::where('id', $productId)->with('company')->with('sector')->with('category')->first();
        return view('back-end.user-dashboard.research.status_edit', compact('product'));
    }

    /**
     * admin product status update
     * @param Request $request
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function adminUpdate(Request $request, $productId) {
        try {
            $product = Product::find($productId);
            $product->status = $request->status;

            $product->save();

        } catch (\Exception $e) {
            return "product update error: " . $e->getMessage();
        }
        $successMessage = '';
        if($request->status == "Approved") $successMessage = 'Product Status Approved';
        else $successMessage = 'Product Status Pending';

        return redirect()->route('admin.research.admin.edit', $productId)->with('success', $successMessage);
    }

    public function purchasedItem() {
        $userId = Auth::id();
        try {
            $orders = Order::where('user_id','=', $userId)->get();
            $products = [];
            foreach ($orders as $order) {
                foreach ($order->orderItems as $item){
                    array_push($products, $item->product);
                }
            }
//            return $product;
        } catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }
        return view('back-end.user-dashboard.purchased-item.index', compact('products'));
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
