<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    // 📌 SHOW ALL
    public function index()
    {
        $quotations = Quotation::latest()->get();
        return view('quotations.index', compact('quotations'));
    }

    // 📌 SHOW CREATE FORM
    public function create()
    {
        return view('quotations.create');
    }

    // 📌 STORE DATA
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'product' => 'required',
            'amount' => 'required|numeric',
        ]);

        Quotation::create($request->all());

        return redirect()->route('quotations.index')
            ->with('success', 'Quotation Created Successfully');
    }

    // 📌 SHOW SINGLE (optional but useful for viva)
    public function show($id)
    {
        $quotation = Quotation::findOrFail($id);
        return view('quotations.show', compact('quotation'));
    }

    // 📌 EDIT FORM
    public function edit($id)
    {
        $quotation = Quotation::findOrFail($id);
        return view('quotations.edit', compact('quotation'));
    }

    // 📌 UPDATE DATA
    public function update(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);

        $request->validate([
            'client_name' => 'required',
            'product' => 'required',
            'amount' => 'required|numeric',
        ]);

        $quotation->update($request->only([
            'client_name',
            'product',
            'amount',
            'valid_till',
            'notes'
        ]));

        return redirect()->route('quotations.index')
            ->with('success', 'Quotation Updated Successfully');
    }

    // 📌 DELETE
    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();

        return redirect()->route('quotations.index')
            ->with('success', 'Quotation Deleted');
    }
}