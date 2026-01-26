<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Counter;
use App\Models\Deposite;
use App\Models\Lotter;
use App\Models\Notice;
use App\Models\Partner;
use App\Models\Privacypolicy;
use App\Models\Slider;
use App\Models\User_widthdraw;
use App\Models\Whychooseinvestmentplan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function frontend()
    {

        $sliders = Slider::all();
        $partners = Partner::all();
        return view('Frontend.index',compact('sliders','partners'));
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

}
