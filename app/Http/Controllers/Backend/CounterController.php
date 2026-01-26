<?php

namespace App\Http\Controllers\Backend;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counter=Counter::all();
        return view('Admin.counter.index',compact('counter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.counter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'icon'   => 'nullable|string|max:255',
        'title'  => 'required|string|max:255',
        'value'  => 'required|string|max:255',
        'status' => 'required|boolean',
    ]);

    // 2️⃣ Create new counter
    Counter::create([
        'icon'   => $request->icon,
        'title'  => $request->title,
        'value'  => $request->value,
        'status' => $request->status,
    ]);

    // 3️⃣ Redirect back with success message
    return redirect()->route('counter.index')->with('success', 'Counter created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $counter=Counter::find($id);
        return view('Admin.counter.edit',compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Counter $counter)
{
    // 1️⃣ Validate input
    $request->validate([
        'icon'   => 'nullable|string|max:255',
        'title'  => 'required|string|max:255',
        'value'  => 'required|string|max:255',
        'status' => 'required|boolean',
    ]);

    // 2️⃣ Update counter using the instance
    $counter->update([
        'icon'   => $request->icon,
        'title'  => $request->title,
        'value'  => $request->value,
        'status' => $request->status,
    ]);

    // 3️⃣ Redirect back with success message
    return redirect()->route('counter.index')->with('success', 'Counter updated successfully!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // 1️⃣ Find the counter
    $counter = \App\Models\Counter::find($id);

    if (!$counter) {
        return redirect()->route('counter.index')->with('error', 'Counter not found.');
    }

    // 2️⃣ Delete the counter
    $counter->delete();

    // 3️⃣ Redirect with success message
    return redirect()->route('counter.index')->with('success', 'Counter deleted successfully!');
}

}
