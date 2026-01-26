<?php

namespace App\Http\Controllers\Backend;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\Whychooseinvestmentplan;
use Illuminate\Http\Request;

class WhychooseinvestmentplanConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whychooseus = Whychooseinvestmentplan::all();
       return view('Admin.Whychooseusinvesment.index', compact('whychooseus'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Whychooseusinvesment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{

    Whychooseinvestmentplan::create([
        'title' => $request->title,
        'description' => $request->description,
        'icon' => $request->icon,
        'main_title' => $request->main_title,
        'main_description' => $request->main_description,
        'status' => $request->status,
    ]);

    return redirect()->route('whychooseusinvesment.index')
                     ->with('success', 'Data added successfully!');
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
        $whychooseus = Whychooseinvestmentplan::find($id);
        return view('Admin.Whychooseusinvesment.edit', compact('whychooseus'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $request->validate([
        'icon' => 'required|string|max:255',
        'main_title' => 'required|string|max:255',
        'main_description' => 'required|string',
        'status' => 'required|boolean',
    ]);

    $whychooseus = Whychooseinvestmentplan::findOrFail($id);

    $whychooseus->update([
        'title' => $request->title,
        'description' => $request->description,
        'icon' => $request->icon,
        'main_title' => $request->main_title,
        'main_description' => $request->main_description,
        'status' => $request->status,
    ]);

    return redirect()->route('whychooseusinvesment.index')
                     ->with('success', 'Why Choose Us Investment updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $whychooseus = Whychooseinvestmentplan::findOrFail($id);
        $whychooseus->delete();

        return redirect()->route('whychooseusinvesment.index')
                         ->with('success', 'Data deleted successfully.');
    }
}
