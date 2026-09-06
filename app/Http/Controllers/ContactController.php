<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // 📄 LIST + SEARCH + PAGINATION
    public function index(Request $request)
    {
        $contacts = Contact::when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%')
                      ->orWhere('phone', 'like', '%' . $request->search . '%')
                      ->orWhere('company', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('contacts.index', compact('contacts'));
    }

    // ➕ CREATE PAGE
    public function create()
    {
        return view('contacts.create');
    }

    // 💾 STORE
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        // ✅ Safe insert
        Contact::create($request->only([
            'name',
            'email',
            'phone',
            'company'
        ]));

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact Added Successfully');
    }

    // ✏️ EDIT PAGE
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        // ✅ Safe update
        $contact->update($request->only([
            'name',
            'email',
            'phone',
            'company'
        ]));

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact Updated Successfully');
    }

    // ❌ DELETE
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact Deleted Successfully');
    }
}