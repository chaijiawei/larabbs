<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = factory(Topic::class)->times(1000)->make();
        Topic::query()->insert($topics->toArray());
    }
}
