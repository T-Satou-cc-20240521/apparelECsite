<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function top()
    {
        $categories = Category::all();
        return view('user.top', compact('categories'));
    }

    public function results(Request $request)
    {
        $category = $request->input('category');
        $query = $request->input('query');
        $products = Product::where('category_id', $category)
                            ->where('name', 'like', '%' . $query . '%')
                            ->get();
        return view('user.top', compact('products', 'query', 'category','categories'));
    }
}
