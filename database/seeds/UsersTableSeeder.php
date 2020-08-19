<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'full_name' => 'Raihan Farhad',
            'contact_number' => '01747201159',
            'profession' => 'Software Engineer',
            'institution' => 'Techynaf',
            'type' => 'admin',
            'email' => 'bdraihan71@gmail.com',
            'email_verified_at' => new DateTime,
            'password' => bcrypt('bangladesh2019'),
        ]);
    }
}
