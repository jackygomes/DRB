<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\NewsletterCategory;
use Illuminate\Http\Request;

class NewsletterFrontendController extends Controller
{
    /**
     * @param int $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($categoryId = 0)
    {
        $newsletterCategories = NewsletterCategory::all();
        return view('front-end.newsletter.index', compact('newsletterCategories', 'categoryId'));
    }

    /**
     * @param $lastNewsletterId
     * @param bool|int $categoryId
     * @return string
     */
    public function getNewsletterByCategory($lastNewsletterId, $categoryId = 0)
    {
        try{
            if($lastNewsletterId == 0 ){
                return $this->initialResponse($categoryId);

            }elseif (($lastNewsletterId != 0) && (Newsletter::min('id') < $lastNewsletterId)){
                return $this->subsequentResponse($categoryId, $lastNewsletterId);

            }else{
                return json_encode([
                    'error' => 'No result exists',
                ]);
            }
        }catch (\Exception $e){
            return json_encode([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param $categoryId
     * @return string
     */
    public function initialResponse($categoryId)
    {
        if($categoryId == 0)
            $newsletters = Newsletter::take(2)->orderBy('id', 'DESC')->get();

        //filtering initial request based on category
        if($categoryId != 0)
            $newsletters = Newsletter::take(2)->orderBy('id', 'DESC')->where('category_id', $categoryId)->take(2)->get();

        return json_encode([
            'items'     => $newsletters,
            'last_id'   => $newsletters->last()->id
        ]);
    }

    /**
     * @param $categoryId
     * @param $lastNewsletterId
     * @return string
     */
    public function subsequentResponse($categoryId, $lastNewsletterId)
    {
        if($categoryId == 0)
            $newsletters = Newsletter::where('id', '<', $lastNewsletterId)->orderBy('id', 'DESC')->take(2)->get();

        if($categoryId != 0)
            $newsletters = Newsletter::where('id', '<', $lastNewsletterId)->orderBy('id', 'DESC')->where('category_id', $categoryId)->take(2)->get();

        return json_encode([
            'success' => true,
            'items'     => $newsletters,
            'last_id'   => $newsletters->last()->id,
        ]);
    }

    public function getSingleNewsletter($id)
    {
        $newsletterCategories = NewsletterCategory::all();
        $newsletter = Newsletter::findOrFail($id);
        return view('front-end.newsletter.single-newsletter', compact('newsletterCategories', 'newsletter'));
    }
}
