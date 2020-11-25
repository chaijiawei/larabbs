<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class SeedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                'name' => '问答',
                'descr' => '有问必答',
            ],
            [
                'name' => '分享',
                'descr' => '好东西来着',
            ],
            [
                'name' => '教程',
                'descr' => '叫兽来了',
            ],
            [
                'name' => '其他',
                'descr' => '....',
            ],
        ];
        Category::query()->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Category::query()->truncate();
    }
}
