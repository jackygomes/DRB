<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(StaticContentSeeder::class);
        // factory(App\Menu::class, 20)->create();
        // factory(App\Page::class, 20)->create();
        // factory(App\PageItem::class, 20)->create();
        // factory(App\Company::class, 20)->create();
        // factory(App\Announcment::class, 20)->create();
        // factory(App\Survey::class, 20)->create();
        // factory(App\SurveyQuestion::class, 20)->create();
        // factory(App\SurveyAnswerOption::class, 20)->create();
        // factory(App\SurveyHit::class, 20)->create();
        // factory(App\Transaction::class, 20)->create();
        // factory(App\StaticContent::class, 20)->create();
        // factory(App\Search::class, 20)->create();
        // factory(App\Sector::class, 20)->create();
        // factory(App\SubscriptionPlan::class, 20)->create();
    }
}
