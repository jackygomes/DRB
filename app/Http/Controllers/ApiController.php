<?php

namespace App\Http\Controllers;

use App\CategoryTracker;
use App\Service\CategoryTrackerService;
use Illuminate\Http\Request;
use App\Company;
use App\News;
use App\StockInfo;
use App\Sector;
use Carbon\Carbon;
use App\Service\DSE;

class ApiController extends Controller
{
    public function getCompany($sector_id)
    {
        if ($sector_id == 'sector') {
            $companies = Company::orderBy('name')->get()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        } else {
            $companies = Company::where('sector_id', $sector_id)->orderBy('name')->get()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        }
        return response()->json($companies);
    }

    public function fetchDSE(Request $request)
    {
        DSE::fetch();
        return response()->json([
            'success' => true
        ]);
    }

    public function getAllNews(Request $request, $time)
    {
        $from = Carbon::now()->subDays($time);
        $to = Carbon::now();
        $allnews = News::where('is_published', 1)->where('heading', 'LIKE', "%$request->search%")->whereBetween('created_at', [$from, $to])->get();

        return response()->json($allnews);
    }

    public function getCustomRangeNews(Request $request, $from, $to)
    {
        $from = Carbon::parse($from);
        $to = Carbon::parse($to);
        $allnews = News::where('is_published', 1)->where('heading', 'LIKE', "%$request->search%")->whereBetween('created_at', [$from, $to])->get();

        return response()->json($allnews);
    }

    public function getNewsByCategory($last_id, $category_id)
    {
        if ($last_id != 0) {
            $allnews = News::where('id', '<', $last_id)->where('category_id', $category_id)->with("comments")->orderBy('created_at', 'DESC')->take(2)->get();
        } else {
            $allnews = News::where('category_id', $category_id)->with("comments")->orderBy('created_at', 'DESC')->take(6)->get();
        }

        if ($allnews->count() > 0) {
            return response()->json([
                'success' => true,
                'items' => $allnews,
                'last_id' => $allnews->last()->id,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'items' => [],
            ]);
        }
    }

    public function getNewsByNewspaper($last_id, $newspaper_id)
    {
        if ($last_id != 0) {
            $allnews = News::where('id', '<', $last_id)->where('newspaper_id', $newspaper_id)->with("comments")->orderBy('created_at', 'DESC')->take(2)->get();
        } else {
            $allnews = News::where('newspaper_id', $newspaper_id)->with("comments")->orderBy('created_at', 'DESC')->take(6)->get();
        }

        if ($allnews->count() > 0) {
            return response()->json([
                'success' => true,
                'items' => $allnews,
                'last_id' => $allnews->last()->id,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'items' => [],
            ]);
        }
    }


    public function getNewsByFilter(Request $request, $last_id, CategoryTrackerService $categoryTrackerService)
    {
        $trackedCategories = CategoryTracker::where('user_id', $request->user_id)->first();

        if($trackedCategories){
            $trackedCategoriesArray = json_decode($trackedCategories->category_visited);
            $request->categories = $categoryTrackerService->getCategoriesWithTracking($trackedCategoriesArray, $request->categories);
        }

        if ($last_id != 0) {
            if ($request->language == 'both') {
                $allnews = News::where('id', '<', $last_id)
                    ->where(function ($query) use ($request){
                        $query->whereIn('category_id', $request->categories)
                            ->orWhereIn('newspaper_id', $request->newspapers);
                    })
                    ->with("comments")->orderBy('created_at', 'DESC')->take(2)->get();
            } else {

                $allnews = News::where('id', '<', $last_id)
                    ->where(function ($query) use ($request){
                        $query->whereIn('category_id', $request->categories)
                            ->orWhereIn('newspaper_id', $request->newspapers);
                    })
                        ->where('language', $request->language)
                        ->with("comments")->orderBy('created_at', 'DESC')->take(2)->get();
            }
        } else {
            if ($request->language == 'both') {
                $allnews = News::whereIn('category_id', $request->categories)
                    ->orWhereIn('newspaper_id', $request->newspapers)
                    ->with("comments")->orderBy('created_at', 'DESC')->take(5)->get();
            } else

                $allnews = News::where(function ($query) use ($request){
                        $query->whereIn('category_id', $request->categories)
                            ->orWhereIn('newspaper_id', $request->newspapers);
                    })
                    ->where('language', $request->language)
                    ->with("comments")->orderBy('created_at', 'DESC')->take(5)->get();

        }

        if ($allnews->count() > 0) {
            return response()->json([
                'success' => true,
                'items' => $allnews,
                'last_id' => $allnews->last()->id,
                'tracked' => $request->categories
            ]);
        } else {
            return response()->json([
                'success' => false,
                'items' => [],
            ]);
        }
    }

    public function getNewsByLastId($last_id)
    {
        if ($last_id != 0) {
            $allnews = News::where('id', '<', $last_id)->with("comments")->orderBy('created_at', 'DESC')->take(2)->get();
        } else {
            $allnews = News::with("comments")->orderBy('created_at', 'DESC')->take(6)->get();
        }

        if ($allnews->count() > 0) {
            return response()->json([
                'success' => true,
                'items' => $allnews,
                'last_id' => $allnews->last()->id,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'items' => [],
            ]);
        }
    }

}
