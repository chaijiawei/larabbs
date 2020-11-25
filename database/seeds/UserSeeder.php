<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->times(10)->create();
        User::query()->find(1)->update(
            [
                'name' => 'cjw',
                'email' => 'jiawei_chai@126.com'
            ]
        );
    }
}
