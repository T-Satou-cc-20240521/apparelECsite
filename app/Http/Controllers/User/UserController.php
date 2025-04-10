<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function top()
    {
        $categories = Category::all();
        $banners = Banner::where('is_active', 1)
            ->where('start_at', '<=', now())
            ->where('end_at', '>=', now())
            ->orderBy('priority', 'desc')
            ->get();

        return view('user.top', compact('categories', 'banners'));
    }

    public function searchForm()
    {
        $categories = Category::all();
        return view('search.form', compact('categories'));
    }

    public function showBanners()
    {
        
    }
}
