<?php
/**
 * Created by PhpStorm.
 * User: Lizard
 * Date: 11/17/2020
 * Time: 1:52 PM
 */

namespace App\Service;


use App\CategoryTracker;

class CategoryTrackerService
{
    public function trackVisitedCategory($categoryId){

        if( $visitedCategories = CategoryTracker::where('user_id', auth()->user()->id)->first()){

            $categories = json_decode($visitedCategories->category_visited);

            $flag = true;

            foreach ($categories as $key => $category){
                if(array_key_exists($categoryId, (array) $category)){

                    $arrayKey = array_key_first((array) $categories[$key]);

                    $categories[$key]->$arrayKey = $categories[$key]->$arrayKey + 1;

                    $visitedCategories->update([
                        'category_visited' => json_encode($categories)
                    ]);

                    $flag = false;

                }
            }


            if($flag){
                array_push($categories, (object) [$categoryId => 1]);
                $visitedCategories->update([
                    'category_visited' => json_encode($categories)
                ]);
            }

        }else{
            CategoryTracker::create([
                'user_id' => auth()->user()->id,
                'category_visited' => json_encode([[$categoryId => 1]], true)
            ]);
        }
    }

}