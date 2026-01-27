<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Counter;
use App\Models\Deposite;
use App\Models\Lotter;
use App\Models\Mission;
use App\Models\Notice;
use App\Models\Partner;
use App\Models\Passionsection;
use App\Models\Privacypolicy;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\User_widthdraw;
use App\Models\Whychooseinvestmentplan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
   public function frontend()
{
    // Eager load relationships to avoid N+1 queries
    $products = Product::with(['category', 'subcategory'])
        ->latest()
        ->limit(6) // Show only 6 products on home page
        ->get();

    $sliders = Slider::orderBy('id', 'desc')->get();

    $partners = Partner::orderBy('id', 'desc')->get();

    $settings = Setting::first();

    // Categories with subcategories (already optimized)
    $categories = Category::with('subcategories')->get();
    $about = About::orderBy('id', 'desc')->get();
    $mission = Mission::orderBy('id', 'desc')->get();
    $passion = Passionsection::orderBy('id', 'desc')->get();

    // No need to load all subcategories separately since they're already loaded with categories

    return view('Frontend.index', compact(
        'sliders',
        'partners',
        'settings',
        'categories',
        'products',
        'about',
        'mission',
        'passion',
    ));
}
    public function privacy()
    {
        $priavacypolicy =Privacypolicy::all();
        return view('Frontend.pages.privacy',compact('priavacypolicy'));
    }

    public function contacts()
    {
        $contacts = \App\Models\Contact::all();
         return view('Frontend.pages.contact', compact('contacts'));
    }
    // User registration and login methods can be added here
    public function termsconditions()
    {
        $termscondition = \App\Models\Termscondition::all();
         return view('Frontend.pages.termscondition', compact('termscondition'));
    }




public function productdetails($slug)
{
    $settings = Setting::first();
    $categories = Category::all();
    $subcategories = Subcategory::all();
    $product = Product::where('product_slug', $slug)->firstOrFail();
    $relatedProducts = Product::where('category_id', $product->category_id)
                              ->where('id', '!=', $product->id)
                              ->limit(4)
                              ->get();

    return view('Frontend.pages.productdetails', compact('categories', 'subcategories', 'product', 'relatedProducts', 'settings'));
}

}
