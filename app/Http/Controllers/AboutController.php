<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class AboutController extends Controller
{
    public function index($category = null)

    {
        $categories = Category::all();
        if ($category) {
            $selectedCategory = Category::where('name', $category)->first();
            if ($selectedCategory) {
                 $allProducts = Product::where('category_id', $selectedCategory->id)->get();
            } else {
                $allProducts = collect(); 
            }
        } else {
            $allProducts = Product::all();
        }

        return view('about', compact('allProducts', 'categories'));
    }
}
