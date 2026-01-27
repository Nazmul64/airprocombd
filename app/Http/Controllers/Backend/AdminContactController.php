<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contacform;
use App\Models\ContactForm;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    // Show all contacts with filtering
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = Contacform::query()->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $contacts = $query->paginate(20);

        return view('Admin.contact.index', compact('contacts', 'status'));
    }

    // Show single contact
    public function show(Contacform $contact)
    {
        // Automatically mark as read if it's pending
        if ($contact->status === 'pending') {
            $contact->update(['status' => 'read']);
        }

        return view('Admin.contact.show', compact('contact'));
    }

    // Update contact status
    public function updateStatus(Request $request, Contacform $contact)
    {
        $request->validate([
            'status' => 'required|in:pending,read,replied',
        ]);

        $contact->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Contact status updated successfully!');
    }

    // Delete single contact
    public function destroy(Contacform $contact)
    {
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Contact deleted successfully!');
    }

    // Bulk delete contacts
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'contact_ids' => 'required|array',
            'contact_ids.*' => 'exists:contact_forms,id',
        ]);

        Contacform::whereIn('id', $request->contact_ids)->delete();

        return redirect()->back()->with('success', 'Selected contacts deleted successfully!');
    }
}
