<?php

namespace App\Http\Controllers;

use App\Category;
use App\MostRecent;
use App\NewsForYou;
use App\Newspaper;
use App\Service\CategoryTrackerService;
use Illuminate\Http\Request;
use App\News;
use Auth;

class NewsController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_published', 1)->orderBy('order', 'asc')->get();
        // $allnews = News::where('is_published', 1)->latest()->paginate(20);
        $mostrecents = MostRecent::where('is_published', 1)->orderBy('created_at', 'DESC')->get();
        // return view('front-end.news.index', compact('allnews','mostrecents','categories'));

        $newspapers = Newspaper::get();
        return view('front-end.news.continuous-index', compact('mostrecents','categories', 'newspapers'));
    }

    public function singleNews($id)
    {
        $news = News::find($id);
        $latestNews = News::orderBy('id', 'desc')->get()->take(30);
        $categories = Category::get();
//        return $latestNews[0];

        list($imageWidth, $imageHeight) = getimagesize(env('S3_URL') . $news->image);

        return view('front-end.news.single-news', compact('news', 'latestNews', 'categories', 'imageWidth', 'imageHeight'));
    }

    public function newsPortal()
    {
        $categories = Category::where('is_published', 1)->orderBy('order', 'asc')->get();
        $newspapers = Newspaper::paginate();
        $allnews = News::orderBy('id', 'DESC')->paginate(10);
        return view('back-end.news.index', compact('allnews','categories', 'newspapers'));
    }

    public function newsStore (Request $request)
    {
        $request->merge([
            'source' => urldecode($request->get('source')),
        ]);
        // dd( $request->source);
        $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'heading' => 'required|min:3|max:255',
            'source' => 'required|max:255',
            'body' => 'required|max:200',
            'category_id' => 'required',
            'newspaper_id' => 'required',
            'language' => 'required',
        ]);

        if($request->file('image')){
            try{
                $epath = $request->file('image')->store(
                    env('APP_ENV') . '/news/images' , 's3'
                );
            }catch(\Exception $exception){
                $exception->getMessage();
                return back()->withError("There was an error with uploading your file")->withInput();
            }

            $path = $epath;
        }else{
            $path = "";
        }

        if($request->get('is_published') == null){
            $is_published = 0;
          } else {
            $is_published = request('is_published');
        }

        $news = new News([
            'user_id' => Auth::user()->id,
            'image' => $path,
            'heading' => $request->get('heading'),
            'source' => $request->get('source'),
            'body' => $request->get('body'),
            'showing_area' => $request->get('showing_area'),
            'category_id' => $request->get('category_id'),
            'newspaper_id' => $request->get('newspaper_id'),
            'is_published' => $is_published,
            'language' => $request->get('language'),
        ]);
        $news->save();
        return redirect()->back()->with('success', 'News has been created successfully');

    }

    public function newsEdit($id)
    {
        $categories = Category::where('is_published', 1)->orderBy('order', 'asc')->get();
        $news = News::find($id);
        $newspapers = Newspaper::get();
        return view('back-end.news.edit', compact('news','categories', 'newspapers'));
    }

    public function newsUpdate(Request $request, $id)
    {
        $request->merge([
            'source' => urldecode($request->get('source')),
        ]);
        
        $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'heading' => 'required|min:3|max:255',
            'source' => 'required|max:255',
            'body' => 'required|max:200',
            'category_id' => 'required',
            'language' => 'required',
        ]);

        if($request->file('image')){
            try{
                $epath = $request->file('image')->store(
                    env('APP_ENV') . '/news/images' , 's3'
                );
            }catch(\Exception $exception){
                $exception->getMessage();
                return back()->withError("There was an error with uploading your file")->withInput();
            }

            $path = $epath;
        }else {
            $path = $request->img;
        }

        if($request->get('is_published') == null){
            $is_published = 0;
          } else {
            $is_published = request('is_published');
        }

        $news = News::find($id);
        $news->user_id = Auth::user()->id;
        $news->image = $path;
        $news->heading = $request->get('heading');
        $news->source = $request->get('source');
        $news->body = $request->get('body');
        $news->category_id = $request->get('category_id');
        $news->showing_area = $request->get('showing_area');
        $news->newspaper_id = $request->newspaper_id;
        $news->is_published = $is_published;
        $news->language = $request->get('language');
        $news->save();
        return redirect()->route('news.portal')->with('success', 'News has been updated successfully');
    }

    public function newsDestroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect()->back()->with('success', 'News has been deleted successfully');
    }

    public function newsSearch(Request $request)
    {
        $allnews = News::where('is_published', 1)->where('heading', 'LIKE', "%$request->search%")->latest()->paginate(10);
        return view('front-end.news.index', compact('allnews'));
    }

    public function newsByCategoty($category, CategoryTrackerService $categoryTrackerService)
    {
        $category = Category::where('name', $category)->first();

        if(auth()->user()){
            $categoryTrackerService->trackVisitedCategory($category->id);
        }

        $categories = Category::where('is_published', 1)->orderBy('order', 'asc')->get();
//        $newsSources = News::where('is_published', 1)->first();
        $mostrecents = MostRecent::where('is_published', 1)->orderBy('created_at', 'DESC')->get();
        $category_id = $category->id;
        $newspapers = Newspaper::get();
        return view('front-end.news.continuous-index-category', compact('mostrecents','categories','category', 'category_id', 'newspapers'));
    }

    public function newsByNewspaper($id)
    {
        $newspaper = Newspaper::where('id', $id)->first();
        $newspapers = Newspaper::get();
        $categories = Category::where('is_published', 1)->orderBy('order', 'asc')->get();
        return view('front-end.news.newspaper', compact('categories', 'newspaper', 'newspapers'));
    }
}
