<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Contactinfo;
use App\Models\Counter;
use App\Models\Deposite;
use App\Models\Lotter;
use App\Models\Mission;
use App\Models\Notice;
use App\Models\Partner;
use App\Models\Passionsection;
use App\Models\Privacypolicy;
use App\Models\Product;
use App\Models\Serviceprovider;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Solutionprovider;
use App\Models\Subcategory;
use App\Models\User_widthdraw;
use App\Models\Whychooseinvestmentplan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
public function frontend()
{
    // Latest 6 products with category and subcategory
    $products = Product::with(['category', 'subcategory'])
        ->latest()
        ->limit(6)
        ->get();

    $sliders = Slider::latest()->get();
    $partners = Partner::latest()->get();
    $settings = Setting::first();
    $categories = Category::with('subcategories')->get();
    $about = About::latest()->get();
    $mission = Mission::latest()->get();
    $passion = Passionsection::latest()->get();

    // Solution providers and services
    $solutionprovider  = Solutionprovider::latest()->get();
    $services = Serviceprovider::latest()->get();

    // Split services into left and right for frontend display
    $leftProviders = $services->where('side', 'left');
    $rightProviders = $services->where('side', 'right');

    return view('Frontend.index', compact(
        'sliders',
        'partners',
        'settings',
        'categories',
        'products',
        'about',
        'mission',
        'passion',
        'solutionprovider',
        'services',
        'leftProviders',
        'rightProviders'
    ));
}

    public function privacy()
    {
        $priavacypolicy =Privacypolicy::all();
        return view('Frontend.pages.privacy',compact('priavacypolicy'));
    }

    public function contacts()

    {
        $contactinfo=Contactinfo::first();
        $settings = Setting::first();
        $categories = Category::with('subcategories')->get();
        $contacts = \App\Models\Contacform::all();
         return view('Frontend.pages.contact', compact('contacts','categories','settings','contactinfo'));
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
