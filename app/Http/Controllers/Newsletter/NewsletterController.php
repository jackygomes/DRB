<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterPostRequest;
use App\Models\Newsletter;
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
        return view('back-end.newsletter.create');
    }

    /**
     * @param NewsletterPostRequest $request
     * @return $this
     */
    public function store(NewsletterPostRequest $request)
    {
        $filename = $this->storeThumbnailImage($request);

        $data = $request->validated();
        $data['thumbnail'] = $filename;
        $data['created_by'] = auth()->user()->id;
        $data['newsletter_content'] = json_encode([
            'data' => $request->newsletter_content
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

        if(!Storage::exists('public/newsletter_thumbnail')){
            Storage::makeDirectory('public/newsletter_thumbnail');
        }

        $filename = time(). '.' .$request->file('thumbnail')->extension();
        $thumbnail->save(storage_path('app/public/newsletter_thumbnail/') . $filename);

        return $filename;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('back-end.newsletter.edit', compact('newsletter'));
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
            'thumbnail'         => 'mimes:jpg,png',
            'newsletter_content'=> 'string',
        ]);

        $data = $request->all();
        $newsletter = Newsletter::findOrFail($id);

        //storing thumbnail
        if($request->has('thumbnail')){
            $filename = $this->storeThumbnailImage($request);
            $data['thumbnail'] = $filename;

            //removing previous thumbnail from storage
            Storage::delete('public/newsletter_thumbnail/' . $newsletter->thumbnail);
        }

        if($request->has('newsletter_content')){
            $data['newsletter_content'] = json_encode([
                'data' => $request->newsletter_content
            ]);
        }

        $newsletter->update($data);
        return redirect()->route('back-end.newsletter.edit')->with(['success' => 'Updated Successfully']);
    }

    /**
     * @param $id
     * @return $this
     */
    public function delete($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        Storage::delete('public/newsletter_thumbnail/' . $newsletter->thumbnail);
        $newsletter->delete();
        return redirect()->route('back-end.newsletter.idex')->with(['success' => 'Deleted Successfully']);
    }
}
