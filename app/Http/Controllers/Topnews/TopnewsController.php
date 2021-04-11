<?php

namespace App\Http\Controllers\Topnews;

use App\Http\Controllers\Controller;
use App\Models\Topnews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopnewsController extends Controller
{
    public function index()
    {
        $topnews = Topnews::all();
        return view('back-end.topnews.index', compact('topnews'));
    }

    public function create()
    {
        return view('back-end.topnews.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'heading'   => 'required',
            'source'     => 'required',
            'source_name' => 'required',
            'image'      => 'required|max:500|mimes:jpg,jpeg,png'
        ]);

        if($request->file('image')){
            try{
                $s3ImagePath = $request->file('image')->store(env('APP_ENV') . '/topnews' , 's3');
            }catch(\Exception $exception){
                return back()->withError('Can\'t Upload Image');
            }

            Topnews::create([
               'heading'    => $request->heading,
               'source'     => $request->source,
               'source_name' => $request->source_name,
               'image'      => $s3ImagePath,
            ]);
        }

        if(Topnews::count() > 2){
            $oldestNews = Topnews::orderBy('id', 'ASC')->first();
            Storage::disk('s3')->delete($oldestNews->image);
            $oldestNews->delete();
        }

        return redirect()->back()->with('success', 'Topnews Is Added');
    }

    public function edit($id)
    {
        $topnews = Topnews::findOrFail($id);
        return view('back-end.topnews.edit', compact('topnews'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'heading'   => 'string',
            'source'     => 'string',
            'source_name' => 'string',
            'image'      => 'max:500|mimes:jpg,jpeg,png'
        ]);

        $topnews = Topnews::find($id);
        $data = $request->all();

        if($request->file('image')){
            try{
                $s3ImagePath = $request->file('image')->store(env('APP_ENV') . '/topnews' , 's3');
                Storage::disk('s3')->delete($topnews->image);
            }catch(\Exception $exception){
                return back()->withError($exception->getMessage());
            }
        }

        $data['image'] = isset($s3ImagePath) ? $s3ImagePath : $topnews->image;

        $topnews->update($data);

        return redirect()->back()->with('success', 'Topnews Is Updated');
    }

    /**
     * @param $id
     * @return $this
     */
    public function delete($id)
    {
        $topnews = Topnews::find($id);

        if($topnews->image){
            try{
                Storage::disk('s3')->delete($topnews->image);
            }catch(\Exception $exception){
                return back()->withError($exception->getMessage());
            }
        }

        $topnews->delete();

        return redirect()->back()->with('success', 'Topnews has been deleted successfully');
    }
}
