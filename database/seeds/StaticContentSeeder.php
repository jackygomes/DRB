<?php

use Illuminate\Database\Seeder;

class StaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('static_contents')->insert([
            "key" => "phone",
            "value" => "+880 1720 227189",
        ]);

        DB::table('static_contents')->insert([
            "key" => "email",
            "value" => "info@dataresources-bd.com", 
        ]);

        DB::table('static_contents')->insert([
            "key" => "website",
            "value" => "www.dataresourcebd.com",
        ]);

        DB::table('static_contents')->insert([
            "key" => "who_we_are",
            "value" => "DRB aims to provide accurate and workable data to help you make e best investment decision. All the data are collected from secondary source.",
        ]);

        DB::table('static_contents')->insert([
            "key" => "title",
            "value" => "Bangladesh's First Aggregate Data Platform",
        ]);

        DB::table('static_contents')->insert([
            "key" => "subtitle",
            "value" => "More than 1000 Contents",
        ]);
    }
}
