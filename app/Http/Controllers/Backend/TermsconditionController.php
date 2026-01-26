<?php

namespace App\Http\Controllers\Backend;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\Termscondition;
use Illuminate\Http\Request;

class TermsconditionController extends Controller
{
      public function index()
    {
        $termscondition = Termscondition::all();
        return view('Admin.termscondition.index',compact('termscondition'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.termscondition.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Termscondition::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('Termscondition.index')->with('success', 'termscondition created successfully.');
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
    $termscondition = Termscondition::findOrFail($id);
    return view('Admin.termscondition.edit', compact('termscondition'));
}


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Termscondition $id)
{
    // Validation
    $termscondition = Termscondition::findOrFail($id->id);
    $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    // Direct update
    $termscondition->update($request->only(['title', 'description']));

    return redirect()->route('Termscondition.index')
                     ->with('success', 'Terms & Conditions updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    $Termscondition = Termscondition::find($id);
    $Termscondition->delete();

    // Redirect back with success message
    return redirect()->route('Termscondition.index')
                     ->with('success', 'termscondition deleted successfully.');
}
}
