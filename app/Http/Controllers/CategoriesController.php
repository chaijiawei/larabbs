<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request)
    {
        $topics = $category->topics()->withOrder($request->order)->paginate();
        return view('topics.index', compact('topics', 'category'));
    }
}
