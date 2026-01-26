<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\CommissionSetting;
use App\Models\Deposite;
use App\Models\Lotter;
use App\Models\Lottery_result;
use App\Models\Notice;
use App\Models\Profit;
use App\Models\Slider;
use App\Models\User;
use App\Models\Userpackagebuy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserregistionController extends Controller
{
    /**
     * User dashboard
     */
public function userdashboard()
{
    // Current logged-in user (for balance)
    $user = auth()->user();
    $userBalance = $user->userdeposite->sum('amount'); // শুধু মোট ব্যালেন্স

    // Notices, Slider, Packages
    $notices = Notice::all();
    $slider  = Slider::all();
    $today   = now()->startOfDay();
    $packages = Lotter::all();

    // All users withdrawals
    $users_widthraw = User::with('userWidthdraws')->get();

    // All users deposits (for recent deposits scroll)
$users_deposite = User::with('userdeposite')->get();

// প্রতিটি user এর total_deposite_balance calculate
$users_deposite->each(function($user) {
    $user->total_deposite_balance = $user->userdeposite->sum('amount')
        + Userpackagebuy::where('user_id', $user->id)->sum('price'); // adjust column
});

// শুধুমাত্র যারা deposits করেছে তারা filter
$users_deposite = $users_deposite->filter(function($user) {
    return $user->total_deposite_balance > 0;
});
    // Package winners
    $packageWinners = [];
    foreach ($packages as $package) {
        $packageWinners[$package->id] = Lottery_result::with(['user', 'userPackageBuy'])
            ->whereHas('userPackageBuy', function ($q) use ($package) {
                $q->where('package_id', $package->id);
            })
            ->where('draw_date', '>=', $today)
            ->orderBy('position')
            ->take(3)
            ->get();
    }

    return view('userdashboard.index', compact(
        'slider',
        'notices',
        'packages',
        'packageWinners',
        'users_widthraw',
        'users_deposite',
        'userBalance',

    ));
}








    /**
     * Show login form
     */
    public function userlogin()
    {
        return view('Frontend.login.login');
    }

    /**
     * Show register form
     */
    public function register(Request $request)
    {
        $refCode = $request->query('ref'); // referral code from URL
        return view('Frontend.login.register', compact('refCode'));
    }

    /**
     * Handle register form submit
     */
    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'nullable|string|max:255|unique:users',
            'phone'    => 'required|string|max:20|unique:users',
            'ref_code' => 'required|string|max:255|exists:users,ref_code',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $referredBy = null;
        if ($request->filled('ref_code')) {
            $refUser = User::where('ref_code', $request->ref_code)->first();
            if ($refUser) {
                $referredBy = $refUser->id;
            }
        }

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'username'    => $request->username ?? Str::random(8),
            'phone'       => $request->phone,
            'ref_code'    => strtoupper(Str::random(8)),
            'referred_by' => $referredBy,
            'status'      => 'active', // default active
            'role'        => 'user'
        ]);

        Auth::login($user);

        return redirect()->route('frontend')->with('success', 'Registration successful!');
    }

    /**
     * Handle login submit
     */
    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'user';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Status check (active/inactive)
            if (Auth::user()->status != 'active' && Auth::user()->status != 1) {
                Auth::logout();
                return redirect()->route('user.login')->withErrors([
                    'email' => 'Your account is inactive. Please contact support.',
                ]);
            }

            return redirect()->route('frontend')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Logout user
     */
    public function userlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend')->with('success', 'Successfully logged out!');
    }
}
