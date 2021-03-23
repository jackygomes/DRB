<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\NewsletterCategory;
use Illuminate\Http\Request;

class NewsletterFrontendController extends Controller
{
    public function index()
    {
        $newsletterCategories = NewsletterCategory::all();
//        dd($newsletterCategories->last()->id);
        return view('front-end.newsletter.index', compact('newsletterCategories'));
    }

    public function getNewsletterByCategory($lastNewsletterId, $categoryId = false)
    {
        if($lastNewsletterId == 0 ){
            $newsletters = Newsletter::get()->take(2);
            return json_encode([
                'items'     => $newsletters,
                'last_id'   => $newsletters->last()->id
            ]);
        }
        return json_encode(['blank response']);
    }
}
