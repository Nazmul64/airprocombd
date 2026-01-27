<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::latest()->get();
        return view('Admin.mission.index', compact('missions'));
    }

    public function create()
    {
        return view('Admin.mission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon'        => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Mission::create([
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('mission.index')
            ->with('success', 'Mission created successfully!');
    }

    public function edit($id)
    {
        $mission = Mission::findOrFail($id);
        return view('Admin.mission.edit', compact('mission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'icon'        => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $mission = Mission::findOrFail($id);
        $mission->update([
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('mission.index')
            ->with('success', 'Mission updated successfully!');
    }

    public function destroy($id)
    {
        Mission::findOrFail($id)->delete();

        return redirect()->route('mission.index')
            ->with('success', 'Mission deleted successfully!');
    }
}
