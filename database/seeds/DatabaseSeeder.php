<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(TopicSeeder::class);
         $this->call(ReplySeeder::class);
         $this->call(LinkSeeder::class);

         //refresh cache
        (new User)->refreshActiveUserCache();
    }
}
