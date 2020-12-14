<?php

namespace App\Service;
use Illuminate\Support\Str;
use Overtrue\Pinyin\Pinyin;

class Slug
{
    public function make($str)
    {
        $pinyin = new Pinyin();
        $permalink = $pinyin->permalink($str);

        return Str::slug($permalink);
    }
}
