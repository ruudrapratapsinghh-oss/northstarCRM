<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->isAdmin()
            ? Lead::query()
            : Lead::where('user_id', auth()->id());

    // 🔍 Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    // 🎯 Filter by status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // 📄 Pagination
    $leads = $query->latest()->paginate(10)->withQueryString();

    $todayFollowUps = (clone $query)->whereDate('follow_up_date', today())->get();

    return view('leads.index', compact('leads', 'todayFollowUps'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
        abort(403);
        }
        return view('leads.create');
    }

    public function store(Request $request)
    {
        
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }   

        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'company' => 'nullable',
        ]);

        Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'status' => 'new',
            'user_id' => Auth::id(),
            'follow_up_date' => $request->follow_up_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead added successfully!');
    }

    public function edit(Lead $lead){
       
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('leads.edit', compact('lead'));
        
    }

    public function update(Request $request, Lead $lead){
        
        if (!auth()->user()->isAdmin()) {
         abort(403);
        }
        
        $lead->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'status' => $request->status,
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully!');
    }

    public function destroy(Lead $lead){
        
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        $lead->delete();
        return redirect()->route('leads.index')->with('success','Lead deleted successfully!');
    }

    public function export()
    {
    $leads = auth()->user()->isAdmin()
        ? Lead::all()
        : Lead::where('user_id', auth()->id())->get();

    $filename = "leads.csv";

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate",
        "Expires" => "0"
    ];

    $columns = ['ID', 'Name', 'Email', 'Phone', 'Company', 'Status'];

    $callback = function() use($leads, $columns) {
        $file = fopen('php://output', 'w');

        // header row
        fputcsv($file, $columns);

        // data rows
        foreach ($leads as $lead) {
            fputcsv($file, [
                $lead->id,
                $lead->name,
                $lead->email,
                $lead->phone,
                $lead->company,
                $lead->status
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
    }

}