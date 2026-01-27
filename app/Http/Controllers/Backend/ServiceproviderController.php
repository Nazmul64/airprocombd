<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Serviceprovider;
use App\Models\serviceprovider_items;
use App\Models\ServiceproviderItem;
use Illuminate\Http\Request;

class ServiceproviderController extends Controller
{
    public function index()
    {
        $leftProviders = Serviceprovider::where('side', 'left')
            ->orderBy('order')
            ->with('items')
            ->get();

        $rightProviders = Serviceprovider::where('side', 'right')
            ->orderBy('order')
            ->with('items')
            ->get();

        return view('Admin.serviceprovider.index', compact('leftProviders', 'rightProviders'));
    }

    public function create()
    {
        return view('Admin.serviceprovider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'side' => 'required|in:left,right',
            'items' => 'array',
            'items.*' => 'nullable|string|max:255',
        ]);

        // Create the service provider
        $serviceProvider = Serviceprovider::create([
            'title' => $request->title,
            'side' => $request->side,
            'order' => Serviceprovider::where('side', $request->side)->max('order') + 1,
        ]);

        // Add items if provided
        if ($request->has('items')) {
            foreach ($request->items as $index => $itemName) {
                if (!empty($itemName)) {
                    serviceprovider_items::create([
                        'serviceprovider_id' => $serviceProvider->id,
                        'item_name' => $itemName,
                        'order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('serviceprovider.index')->with('success', 'Service Provider added successfully!');
    }

    public function edit(Serviceprovider $serviceprovider)
    {
        $serviceprovider->load('items');
        return view('Admin.serviceprovider.edit', compact('serviceprovider'));
    }

    public function update(Request $request, Serviceprovider $serviceprovider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'side' => 'required|in:left,right',
            'items' => 'array',
            'items.*' => 'nullable|string|max:255',
        ]);

        // Update service provider
        $serviceprovider->update([
            'title' => $request->title,
            'side' => $request->side,
        ]);

        // Delete old items
        $serviceprovider->items()->delete();

        // Add new items
        if ($request->has('items')) {
            foreach ($request->items as $index => $itemName) {
                if (!empty($itemName)) {
                    serviceprovider_items::create([
                        'serviceprovider_id' => $serviceprovider->id,
                        'item_name' => $itemName,
                        'order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('serviceprovider.index')->with('success', 'Service Provider updated successfully!');
    }

    public function destroy(Serviceprovider $serviceprovider)
    {
        $serviceprovider->delete(); // Items will be deleted automatically due to cascade
        return redirect()->route('serviceprovider.index')->with('success', 'Service Provider deleted successfully!');
    }
}
