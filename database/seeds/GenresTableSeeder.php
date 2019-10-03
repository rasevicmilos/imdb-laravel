<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'name' => "Comedy"
        ]);

        DB::table('genres')->insert([
            'name' => "Action"
        ]);

        DB::table('genres')->insert([
            'name' => "Drama"
        ]);

        DB::table('genres')->insert([
            'name' => "Horror"
        ]);
    }
}
