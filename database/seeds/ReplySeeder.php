<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $replies = factory(Reply::class)->times(1000)->make();

        Reply::query()->insert($replies->toArray());
    }
}
