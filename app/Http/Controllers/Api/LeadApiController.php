<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadApiController extends Controller
{
    // GET /api/leads
    public function index()
    {
        if(auth()->user()->isAdmin()){
             return Lead::latest()->paginate(5); //admin can see all
        }
        return Lead::where('user_id', auth()->id())->latest()->paginate(5);
    }

    // POST /api/leads
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'status' => 'nullable|string'
        ]);

        $lead = Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'status' => $request->status ?? 'new',
            'user_id' => auth()->id()
        ]);

        return response()->json($lead, 201);
    }

    // GET /api/leads/{id}
    public function show(Lead $lead)
    {
        $this->authorizeLead($lead);

        return response()->json($lead);
    }

    // PUT /api/leads/{id}
    public function update(Request $request, Lead $lead)
    {
        $this->authorizeLead($lead);

        $lead->update($request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|string|max:20',
            'company' => 'sometimes|nullable|string|max:255',
            'status' => 'sometimes|required|in:new,contacted,converted',
        ]));

        return response()->json($lead);
    }

    // DELETE /api/leads/{id}
    public function destroy(Lead $lead)
    {
        $this->authorizeLead($lead);

        $lead->delete();

        return response()->json(['message' => 'Deleted']);
    }

    private function authorizeLead(Lead $lead): void
    {
        abort_unless(auth()->user()->isAdmin() || $lead->user_id === auth()->id(), 403);
    }
}