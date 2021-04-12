<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\NewsletterCategory;

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
     * @param string $publishingDate
     * @return string
     */
    public function getNewsletterByCategory($lastNewsletterId, $categoryId = 0, $publishingDate = '')
    {
        try{
            if($lastNewsletterId == 0 ){
                return $this->initialResponse($categoryId, $publishingDate);

            }elseif (($lastNewsletterId != 0) && (Newsletter::min('id') < $lastNewsletterId)){
                return $this->subsequentResponse($categoryId, $lastNewsletterId, $publishingDate);

            }else{
                return json_encode([
                    'date_search' => true
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
     * @param $publishingDate
     * @return string
     */
    public function initialResponse($categoryId, $publishingDate)
    {
        if($categoryId == 0){
            if($publishingDate)
                $newsletters = Newsletter::orderBy('id', 'DESC')
                    ->where('publishing_date', '<=', now()->timezone('Asia/Dhaka')->toDateString())
                    ->where('publishing_date', $publishingDate)
                    ->with('category')
                    ->take(1)
                    ->get();
            else
                $newsletters = Newsletter::orderBy('id', 'DESC')
                    ->where('publishing_date', '<=', now()->timezone('Asia/Dhaka')->toDateString())
                    ->with('category')
                    ->take(1)
                    ->get();
        }

        //filtering initial request based on category
        if($categoryId != 0){
            if($publishingDate)
                $newsletters = Newsletter::orderBy('id', 'DESC')
                    ->where('publishing_date', '<=', now()->timezone('Asia/Dhaka')->toDateString())
                    ->where('publishing_date', $publishingDate)
                    ->where('category_id', $categoryId)
                    ->with('category')
                    ->take(1)
                    ->get();
            else
                $newsletters = Newsletter::orderBy('id', 'DESC')
                    ->where('publishing_date', '<=', now()->timezone('Asia/Dhaka')->toDateString())
                    ->where('category_id', $categoryId)
                    ->with('category')
                    ->take(1)
                    ->get();
        }

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
    public function subsequentResponse($categoryId, $lastNewsletterId, $publishingDate)
    {
        if($categoryId == 0){
            if($publishingDate)
                $newsletters = Newsletter::where('id', '<', $lastNewsletterId)
                    ->where('publishing_date', '<=', now()->timezone('Asia/Dhaka')->toDateString())
                    ->where('publishing_date', $publishingDate)
                    ->with('category')
                    ->orderBy('id', 'DESC')->take(8)->get();
            else
                $newsletters = Newsletter::where('id', '<', $lastNewsletterId)
                    ->where('publishing_date', '<=', now()->timezone('Asia/Dhaka')->toDateString())
                    ->with('category')
                    ->orderBy('id', 'DESC')->take(8)->get();
        }

        if($categoryId != 0){
            if($publishingDate)
                $newsletters = Newsletter::where('id', '<', $lastNewsletterId)
                    ->where('publishing_date', '<=', now()->timezone('Asia/Dhaka')->toDateString())
                    ->where('publishing_date', $publishingDate)
                    ->with('category')
                    ->orderBy('id', 'DESC')->where('category_id', $categoryId)->take(8)->get();
            else
                $newsletters = Newsletter::where('id', '<', $lastNewsletterId)
                    ->where('publishing_date', '<=', now()->timezone('Asia/Dhaka')->toDateString())
                    ->with('category')
                    ->orderBy('id', 'DESC')->where('category_id', $categoryId)->take(8)->get();
        }

        try{
            return json_encode([
                'success' => true,
                'items'     => $newsletters,
                'last_id'   => $newsletters->last()->id,
            ]);
        }catch (\Exception $e){
            return json_encode([
                'success' => false,
                'date_search' => true
            ]);
        }
    }

    public function getSingleNewsletter($id)
    {
        $newsletterCategories = NewsletterCategory::all();
        $newsletter = Newsletter::findOrFail($id);
        return view('front-end.newsletter.single-newsletter', compact('newsletterCategories', 'newsletter'));
    }
}
