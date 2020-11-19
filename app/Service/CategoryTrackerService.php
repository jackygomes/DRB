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

        if( $visitedCategoriesData = CategoryTracker::where('user_id', auth()->user()->id)->first()){

            $visitedCategories = json_decode($visitedCategoriesData->category_visited);

            $flag = true;

            //update existing
            foreach ($visitedCategories as $key => $category){

                if($category->category_id == $categoryId){

                    $visitedCategories[$key]->counter += 1;

                    $visitedCategoriesData->update([
                        'category_visited' => json_encode($visitedCategories)
                    ]);

                    $flag = false;

                }
            }

            //add category in existing tracking data
            if($flag){
                array_push($visitedCategories, [
                    'category_id' => $categoryId,
                    'counter' => 1
                ]);

                $visitedCategoriesData->update([
                    'category_visited' => json_encode($visitedCategories)
                ]);
            }

        }else{
            //create new tracking
            CategoryTracker::create([
                'user_id' => auth()->user()->id,
                'category_visited' => json_encode([
                    [
                        'category_id' => $categoryId,
                        'counter' => 1
                    ]
                ], true)
            ]);
        }
    }

    public function getCategoriesWithTracking($trackedCategoriesArray, $forYouCategories){
        $countersArray = [];

        //getting sorted counter array
        foreach ($trackedCategoriesArray as $category){
            $countersArray[] = $category->counter;
            rsort($countersArray);
        }

        //getting top 3 counter key (category)
        $categoriesToBeAdded = [];
        foreach ($countersArray as $key => $counter) {
            foreach ($trackedCategoriesArray as $category) {
                if ($category->counter == $counter) {
                    $categoriesToBeAdded[] = $category->category_id;
                }
            }

            if ($key == 2)
                break;
        }

        foreach ($categoriesToBeAdded as $newCategory){
            if(!in_array($newCategory, $forYouCategories)){
                array_push($forYouCategories, $newCategory);
            }
        }

        return $forYouCategories;
    }

}