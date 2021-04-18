<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterPostRequest;
use App\Models\Newsletter;
use App\Models\NewsletterCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsletterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $newsletters = Newsletter::orderBy('id', 'desc')->paginate(15);
        return view('back-end.newsletter.index', compact('newsletters'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $newsletterCategories = NewsletterCategory::all();
        return view('back-end.newsletter.create', compact('newsletterCategories'));
    }

    /**
     * @param NewsletterPostRequest $request
     * @return $this
     */
    public function store(NewsletterPostRequest $request)
    {
        $content = str_replace('<body class', '<body id',$request->newsletter_content);
        $content = str_replace('max-width', 'no-attribute',$content);

        $path = $this->storeThumbnailImage($request);

        $data = $request->validated();
        $data['readable_publishing_date'] = Carbon::parse($request->publishing_date)->format('d M y');
        $data['thumbnail'] = $path;
        $data['created_by'] = auth()->user()->id;
        $data['newsletter_content'] = json_encode([
            'data' => $content
        ]);
        Newsletter::create($data);
        return redirect()->route('newsletter.index')->with(['success' => 'Newsletter Creation Successful']);
    }

    /**
     * @param $request
     * @return string
     */
    public function storeThumbnailImage($request){

        $thumbnail = Image::make($request->file('thumbnail'))->resize(300, 200);

        $fileName = time() . '.jpg';
        Storage::disk('s3')->put(env('APP_ENV') . '/newsletter/' . $fileName, $thumbnail->stream()->__toString());

        return $fileName;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletterCategories = NewsletterCategory::all();
        return view('back-end.newsletter.edit', compact('newsletter', 'newsletterCategories'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'             => 'string',
            'category_id'       => 'string',
            'type'              => 'string',
            'publishing_date'   => 'string',
            'thumbnail'         => 'mimes:jpg,png,jpeg',
            'newsletter_content'=> 'string',
        ]);

        $data = $request->all();

        $data['readable_publishing_date'] = Carbon::parse($request->publishing_date)->format('d M y');

        $newsletter = Newsletter::findOrFail($id);

        //storing thumbnail
        if($request->has('thumbnail')){
            $filename = $this->storeThumbnailImage($request);
            $data['thumbnail'] = $filename;

            //removing previous thumbnail from s3
            Storage::disk('s3')->delete(env('APP_ENV') . '/newsletter/' . $newsletter->thumbnail);
        }

        if($request->has('newsletter_content')){
            $content = str_replace('<body class', '<body id',$request->newsletter_content);
            $data['newsletter_content'] = json_encode([
                'data' => $content
            ]);
        }

        $newsletter->update($data);
        return redirect()->route('newsletter.edit', $newsletter->id)->with(['success' => 'Updated Successfully']);
    }

    /**
     * @param $id
     * @return $this
     */
    public function delete($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        Storage::disk('s3')->delete(env('APP_ENV') . '/newsletter/' . $newsletter->thumbnail);
        $newsletter->delete();
        return redirect()->route('newsletter.index')->with(['success' => 'Deleted Successfully']);
    }
}
