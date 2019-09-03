<?php

use App\Models\Discussion;
use Illuminate\Database\Seeder;

class DiscussionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discussion::truncate();

        factory(Discussion::class, 30)->create();
    }
}
